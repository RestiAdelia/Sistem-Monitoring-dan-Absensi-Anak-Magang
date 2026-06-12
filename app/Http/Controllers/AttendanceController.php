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
    const ALLOWED_RADIUS_METERS = 25;

    // Operational hours
    const CHECKIN_START  = '08:00';
    const CHECKIN_END    = '17:00';
    const CHECKOUT_START = '17:00';
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

        // Validasi field utama
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

        // Deteksi apakah ini checkout lebih awal
        $checkOutStart    = Carbon::createFromTimeString(self::CHECKOUT_START);
        $isEarlyCheckout  = $existingAbsensi
            && !$existingAbsensi->jam_pulang
            && $now->lt($checkOutStart);

        // Validasi keterangan_pulang — wajib jika checkout sebelum CHECKOUT_START
        if ($isEarlyCheckout) {
            $request->validate([
                'keterangan_pulang' => 'required|string|max:255',
            ], [
                'keterangan_pulang.required' => sprintf(
                    'Keterangan wajib diisi karena Anda pulang sebelum pukul %s.',
                    self::CHECKOUT_START
                ),
            ]);
        }

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
                'jam_pulang'        => $now->toTimeString(),
                'latitude_pulang'   => $validated['latitude'],
                'longitude_pulang'  => $validated['longitude'],
                'keterangan_pulang' => $isEarlyCheckout
                    ? $request->input('keterangan_pulang')
                    : null,
            ]);

            return response()->json([
                'success' => true,
                'message' => $isEarlyCheckout
                    ? 'Absen pulang lebih awal berhasil direkam.'
                    : 'Absen pulang berhasil direkam.',
                'data'    => $existingAbsensi->fresh(),
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
                'keterangan_pulang' => null,
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

    public function adminIndex()
    {
        // Memastikan hanya admin yang bisa mengakses data global
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Mengambil semua data absensi anak magang tanpa filter mentor_id
        $absensis = Absensi::with(['user.dataMagang.mentor'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->get();

        return view('admin.absensi.index', compact('absensis'));
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
    // -------------------------------------------------------
    // Mobile API: Pengajuan Izin atau Sakit
    // POST /api/absen/pengajuan
    // -------------------------------------------------------
    public function submitPengajuan(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'status_kehadiran' => 'required|in:Izin,Sakit',
            'keterangan'       => 'required|string|min:10',
            'tanggal_mulai'    => 'required|date|after_or_equal:today',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'lampiran'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $start = Carbon::parse($request->tanggal_mulai);
        $end   = Carbon::parse($request->tanggal_selesai);

        // 1. Cek apakah di rentang tanggal tersebut user sudah punya data absen
        $existing = Absensi::where('user_id', $user->id)
            ->whereBetween('tanggal', [$start->toDateString(), $end->toDateString()])
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal! Anda sudah memiliki data absensi/pengajuan pada rentang tanggal tersebut (' . $existing->tanggal . ').'
            ], 422);
        }

        // 2. Upload Lampiran (satu file untuk semua hari dalam rentang tsb)
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran_absen', 'public');
        }

        // 3. Loop untuk membuat record per hari
        $currentDate = $start->copy();
        $insertedData = [];

        while ($currentDate->lte($end)) {
            // Skip hari Sabtu dan Minggu jika kantor libur (Opsional)
            // if ($currentDate->isWeekend()) {
            //     $currentDate->addDay();
            //     continue;
            // }

            $absensi = Absensi::create([
                'user_id'           => $user->id,
                'tanggal'           => $currentDate->toDateString(),
                'status_kehadiran'  => $request->status_kehadiran,
                'status_approval'   => 'pending',
                'keterangan_pulang' => $request->keterangan, // Menyimpan alasan izin
                'lampiran'          => $lampiranPath,
                'status_kedatangan' => $request->status_kehadiran,
            ]);

            $insertedData[] = $absensi;
            $currentDate->addDay();
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan ' . $request->status_kehadiran . ' untuk ' . count($insertedData) . ' hari berhasil dikirim.',
            'data'    => $insertedData
        ]);
    }

    // -------------------------------------------------------
    // Web Admin: List Pengajuan yang Pending
    // GET /admin/absensi/persetujuan
    // -------------------------------------------------------
    public function pendingApprovals()
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $pendingList = Absensi::with('user')
            ->where('status_approval', 'pending')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.absensi.persetujuan', compact('pendingList'));
    }

    // -------------------------------------------------------
    // Web Admin: Aksi Approve/Reject
    // POST /admin/absensi/approve/{id}
    // -------------------------------------------------------
    // -------------------------------------------------------
    // Web Admin: Aksi Approve/Reject (Mendukung Massal)
    // POST /admin/absensi/approve-batch
    // -------------------------------------------------------
    public function approveReject(Request $request)
    {
        $request->validate([
            'ids'     => 'required|array', // Mengharuskan kiriman berupa array ID
            'ids.*'   => 'exists:absensis,id',
            'status'  => 'required|in:approved,rejected',
            'catatan' => 'nullable|string'
        ]);

        // Update semua data yang ID-nya ada di dalam array $request->ids
        Absensi::whereIn('id', $request->ids)->update([
            'status_approval'  => $request->status,
            'keterangan_admin' => $request->catatan,
            'updated_at'       => now()
        ]);

        $pesan = $request->status === 'approved' ? 'disetujui' : 'ditolak';

        return back()->with('success', "Total " . count($request->ids) . " pengajuan berhasil $pesan.");
    }
    // -------------------------------------------------------
    // Mobile API: Melihat riwayat pengajuan milik sendiri
    // GET /api/absen/riwayat-pengajuan
    // -------------------------------------------------------
    public function riwayatPengajuan()
    {
        $user = Auth::user();

        // Mengambil data yang statusnya Izin atau Sakit saja
        $riwayat = Absensi::where('user_id', $user->id)
            ->whereIn('status_kehadiran', ['Izin', 'Sakit'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar riwayat pengajuan berhasil diambil.',
            'data'    => $riwayat
        ]);
    }
    // Update fungsi summary agar hanya menghitung yang Approved
    public function summary()
    {

        $user  = Auth::user();
    $month = Carbon::now()->month;
    $year  = Carbon::now()->year;

    // 1. Ambil semua data absensi user di bulan berjalan (Tanpa filter approved di awal)
    $records = Absensi::where('user_id', $user->id)
        ->whereMonth('tanggal', $month)
        ->whereYear('tanggal', $year)
        ->get();

    // 2. Hitung 'Hadir' dan 'Terlambat' secara langsung (Otomatis masuk tanpa nunggu approve)
    $hadir = $records->where('status_kehadiran', 'Hadir')->count();
    $terlambat = $records->where('status_kedatangan', 'Terlambat')->count();

    // 3. Hitung 'Izin' dan 'Sakit' HANYA jika sudah disetujui (approved) oleh Admin
    $izin = $records->where('status_kehadiran', 'Izin')
                    ->where('status_approval', 'approved')->count();

    $sakit = $records->where('status_kehadiran', 'Sakit')
                     ->where('status_approval', 'approved')->count();

    // 4. Kembalikan response JSON ke Flutter
    return response()->json([
        'success'   => true,
        'hadir'     => $hadir,
        'izin'      => $izin,
        'sakit'     => $sakit,
        'terlambat' => $terlambat,
    ]);
    }
}
