<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // Define office coordinates and allowed radius (50 meters)
    const OFFICE_LATITUDE = -6.200000;
    const OFFICE_LONGITUDE = 106.816666;
    const ALLOWED_RADIUS_METERS = 50;

    /**
     * Mobile API: Submit attendance (check-in / check-out).
     * Endpoint: POST /api/absen
     */
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
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status_kehadiran' => 'required|in:Hadir,Izin,Sakit',
        ]);

        $today = Carbon::today()->toDateString();
        $existingAbsensi = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        // 1. Geofencing Validation for "Hadir"
        if ($validated['status_kehadiran'] === 'Hadir') {
            $distance = $this->haversineDistance(
                $validated['latitude'],
                $validated['longitude'],
                self::OFFICE_LATITUDE,
                self::OFFICE_LONGITUDE
            );

            if ($distance > self::ALLOWED_RADIUS_METERS) {
                return response()->json([
                    'success' => false,
                    'message' => sprintf(
                        'Anda berada di luar radius kantor. Jarak Anda: %.2f meter (Maksimal %d meter).',
                        $distance,
                        self::ALLOWED_RADIUS_METERS
                    ),
                    'distance' => $distance
                ], 422);
            }
        }

        // 2. Handle Check-in vs Check-out
        if ($existingAbsensi) {
            // If already checked in today, perform check-out
            if ($existingAbsensi->jam_pulang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah melakukan absen masuk dan pulang hari ini.'
                ], 422);
            }

            // Update check-out
            $existingAbsensi->update([
                'jam_pulang' => Carbon::now()->toTimeString(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Absen pulang berhasil direkam.',
                'data' => $existingAbsensi
            ]);
        } else {
            // New check-in
            $absensi = Absensi::create([
                'user_id' => $user->id,
                'tanggal' => $today,
                'jam_masuk' => $validated['status_kehadiran'] === 'Hadir' ? Carbon::now()->toTimeString() : null,
                'jam_pulang' => null,
                'latitude_masuk' => $validated['latitude'],
                'longitude_masuk' => $validated['longitude'],
                'status_kehadiran' => $validated['status_kehadiran'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Absen masuk berhasil direkam.',
                'data' => $absensi
            ], 201);
        }
    }

    /**
     * Web Dashboard: View real-time attendance of mentor's assigned interns.
     */
    public function index()
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        // Retrieve attendance records of interns assigned to this mentor
        $internIds = $mentor->interns()->pluck('id');

        $absensis = Absensi::whereIn('user_id', $internIds)
            ->with('user')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->get();

        return view('mentor.attendance.index', compact('absensis'));
    }

    /**
     * Calculate distance between two coordinate points in meters using Haversine formula.
     */
    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // in meters

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }
}
