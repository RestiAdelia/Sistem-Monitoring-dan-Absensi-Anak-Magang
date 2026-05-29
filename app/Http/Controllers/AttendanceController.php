<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // Office coordinates
    const OFFICE_LATITUDE       = -0.9526046972684186;
    const OFFICE_LONGITUDE      = 100.38929852527497;
    const ALLOWED_RADIUS_METERS = 25; // 25 meter radius

    // Operational hours
    const CHECKIN_START  = '08:00';
    const CHECKIN_END    = '17:00';
    const CHECKOUT_END   = '18:00';
    const LATE_THRESHOLD = '08:15';

    // -------------------------------------------------------
    // Mobile API: Absensi hari ini
    // GET /api/absen/today
    // -------------------------------------------------------
    public function today()
    {
        $user  = Auth::user();
        $today = Carbon::today()->toDateString();

        $absensi = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        return response()->json([
            'success' => true,
            'data'    => $absensi
        ]);
    }

    // -------------------------------------------------------
    // Mobile API: Ringkasan absensi bulan ini
    // GET /api/absen/summary
    // -------------------------------------------------------
    public function summary()
    {
        $user  = Auth::user();
        $month = Carbon::now()->month;
        $year  = Carbon::now()->year;

        $records = Absensi::where('user_id', $user->id)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->get();

        return response()->json([
            'success'   => true,
            'hadir'     => $records->where('status_kehadiran', 'Hadir')->count(),
            'izin'      => $records->where('status_kehadiran', 'Izin')->count(),
            'sakit'     => $records->where('status_kehadiran', 'Sakit')->count(),
            'terlambat' => $records->where('status_kedatangan', 'Terlambat')->count(),
        ]);
    }

    // -------------------------------------------------------
    // Mobile API: Submit absensi (masuk / pulang)
    // POST /api/absen
    // -------------------------------------------------------
    public function submitAttendance(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'magang') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya anak magang yang dapat melakukan presensi.'
            ], 403);
        }

        $validated = $request->validate([
            'latitude'         => 'required|numeric',
            'longitude'        => 'required|numeric',
            'status_kehadiran' => 'required|in:Hadir,Izin,Sakit',
        ]);

        $now   = Carbon::now();
        $today = $now->toDateString();

        $existingAbsensi = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        // 1. Validasi Jam Operasional
        $checkInStart = Carbon::createFromTimeString(self::CHECKIN_START);
        $checkInEnd   = Carbon::createFromTimeString(self::CHECKIN_END);
        $checkOutEnd  = Carbon::createFromTimeString(self::CHECKOUT_END);

        if (!$existingAbsensi) {
            if ($now->lt($checkInStart)) {
                return response()->json([
                    'success' => false,
                    'message' => sprintf(
                        'Absen masuk belum dibuka. Silakan absen mulai pukul %s.',
                        self::CHECKIN_START
                    )
                ], 422);
            }

            if ($now->gt($checkInEnd)) {
                return response()->json([
                    'success' => false,
                    'message' => sprintf(
                        'Waktu absen masuk sudah ditutup sejak pukul %s.',
                        self::CHECKIN_END
                    )
                ], 422);
            }
        } else {
            if ($now->gt($checkOutEnd)) {
                return response()->json([
                    'success' => false,
                    'message' => sprintf(
                        'Waktu absen pulang sudah ditutup sejak pukul %s.',
                        self::CHECKOUT_END
                    )
                ], 422);
            }
        }

        // 2. Geofencing — hanya untuk status "Hadir"
        if ($validated['status_kehadiran'] === 'Hadir') {
            $distance = $this->haversineDistance(
                $validated['latitude'],
                $validated['longitude'],
                self::OFFICE_LATITUDE,
                self::OFFICE_LONGITUDE
            );

            if ($distance > self::ALLOWED_RADIUS_METERS) {
                return response()->json([
                    'success'  => false,
                    'message'  => sprintf(
                        'Anda berada di luar radius kantor. Jarak Anda: %.2f meter (Maksimal %d meter).',
                        $distance,
                        self::ALLOWED_RADIUS_METERS
                    ),
                    'distance' => round($distance, 2)
                ], 422);
            }
        }

        // 3. Check-in vs Check-out
        if ($existingAbsensi) {
            if ($existingAbsensi->jam_pulang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah melakukan absen masuk dan pulang hari ini.'
                ], 422);
            }

            $existingAbsensi->update([
                'jam_pulang'       => $now->toTimeString(),
                'latitude_pulang'  => $validated['latitude'],
                'longitude_pulang' => $validated['longitude'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Absen pulang berhasil direkam.',
                'data'    => $existingAbsensi->fresh()
            ]);

        } else {
            $statusKedatangan = $this->resolveStatusKedatangan(
                $validated['status_kehadiran'],
                $now
            );

            $absensi = Absensi::create([
                'user_id'           => $user->id,
                'tanggal'           => $today,
                'jam_masuk'         => $validated['status_kehadiran'] === 'Hadir'
                                            ? $now->toTimeString()
                                            : null,
                'jam_pulang'        => null,
                'latitude_masuk'    => $validated['latitude'],
                'longitude_masuk'   => $validated['longitude'],
                'latitude_pulang'   => null,
                'longitude_pulang'  => null,
                'status_kehadiran'  => $validated['status_kehadiran'],
                'status_kedatangan' => $statusKedatangan,
            ]);

            $responseData = [
                'success' => true,
                'message' => 'Absen masuk berhasil direkam.',
                'data'    => $absensi,
            ];

            if ($statusKedatangan === 'Terlambat') {
                $lateMinutes = Carbon::createFromTimeString(self::LATE_THRESHOLD)
                    ->diffInMinutes($now);

                $responseData['keterlambatan'] = sprintf(
                    'Anda terlambat %d menit dari batas toleransi pukul %s.',
                    $lateMinutes,
                    self::LATE_THRESHOLD
                );
            }

            return response()->json($responseData, 201);
        }
    }

    // -------------------------------------------------------
    // Web Dashboard: Lihat absensi intern milik mentor
    // GET /mentor/attendance
    // -------------------------------------------------------
    public function index()
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        $internIds = $mentor->interns()->pluck('id');

        $absensis = Absensi::whereIn('user_id', $internIds)
            ->with('user')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->get();

        return view('mentor.attendance.index', compact('absensis'));
    }

    // -------------------------------------------------------
    // Helper: Resolve status kedatangan
    // -------------------------------------------------------
    private function resolveStatusKedatangan(string $statusKehadiran, Carbon $now): string
    {
        if ($statusKehadiran === 'Izin')  return 'Izin';
        if ($statusKehadiran === 'Sakit') return 'Sakit';

        $lateThreshold = Carbon::createFromTimeString(self::LATE_THRESHOLD);

        return $now->lte($lateThreshold) ? 'Tepat Waktu' : 'Terlambat';
    }

    // -------------------------------------------------------
    // Helper: Haversine formula (meter)
    // -------------------------------------------------------
    private function haversineDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371000;

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo   = deg2rad($lat2);
        $lonTo   = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)
        ));

        return $angle * $earthRadius;
    }
}