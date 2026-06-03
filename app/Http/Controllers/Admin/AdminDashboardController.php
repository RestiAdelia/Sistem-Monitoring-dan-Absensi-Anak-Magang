<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DataAnakMagang;
use App\Models\DataMentor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with attendance monitoring.
     */
    public function index(Request $request)
    {
        // Get all mentors for filter dropdown
        $mentors = DataMentor::where('status_akun', 'Aktif')
            ->with('userAccount')
            ->orderBy('nama')
            ->get();

        // Get all active interns' user IDs
        $query = Absensi::with([
            'user.dataMagang.mentor.dataMentor'
        ]);
        
        // Filter by date range if there's data, otherwise show all
        $monthAttendance = (clone $query)->whereBetween('tanggal', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])->count();
        
        if ($monthAttendance > 0) {
            $query->whereBetween('tanggal', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ]);
        } else {
            // If no data this month, show last 30 days
            $query->whereBetween('tanggal', [
                now()->subDays(30),
                now()
            ]);
        }

        // Apply mentor filter if provided
        if ($request->filled('mentor_id')) {
            $mentorData = DataMentor::find($request->mentor_id);
            if ($mentorData && $mentorData->userAccount) {
                // Get all interns assigned to this mentor user
                $internIds = DataAnakMagang::where('mentor_id', $mentorData->userAccount->id)
                    ->where('status_akun', 'Aktif')
                    ->pluck('id');
                
                // Get user IDs for those interns
                $userIds = User::whereIn('data_magang_id', $internIds)
                    ->where('role', 'magang')
                    ->pluck('id');
                
                $query->whereIn('user_id', $userIds);
            }
        }

        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nomor_induk', 'like', "%{$search}%");
            });
        }

        // Get paginated attendance records
        $attendanceRecords = $query->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->paginate(15);

        // Get statistics for the current month
        $totalInterns = DataAnakMagang::where('status_akun', 'Aktif')->count();
        $totalMentors = DataMentor::where('status_akun', 'Aktif')->count();
        $todayAttendance = Absensi::whereDate('tanggal', today())->count();
        $thisMonthAttendance = Absensi::whereBetween('tanggal', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])->count();

        // Get attendance by status for this month
        $attendanceByStatus = Absensi::whereBetween('tanggal', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])
            ->selectRaw('status_kehadiran, COUNT(*) as count')
            ->groupBy('status_kehadiran')
            ->pluck('count', 'status_kehadiran');

        return view('admin.dashboard', compact(
            'attendanceRecords',
            'mentors',
            'totalInterns',
            'totalMentors',
            'todayAttendance',
            'thisMonthAttendance',
            'attendanceByStatus'
        ));
    }

    /**
     * Get attendance statistics by date range
     */
    public function getStatistics(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());
        $mentorId = $request->input('mentor_id');

        $query = Absensi::whereBetween('tanggal', [$startDate, $endDate]);

        if ($mentorId) {
            $mentorUser = User::whereHas('dataMentor', function ($q) use ($mentorId) {
                $q->where('data_mentor.id', $mentorId);
            })->first();
            
            if ($mentorUser) {
                $query->whereHas('user.dataMagang', function ($q) use ($mentorUser) {
                    $q->where('mentor_id', $mentorUser->id);
                });
            }
        }

        $statistics = [
            'total' => $query->count(),
            'hadir' => (clone $query)->where('status_kehadiran', 'Hadir')->count(),
            'izin' => (clone $query)->where('status_kehadiran', 'Izin')->count(),
            'sakit' => (clone $query)->where('status_kehadiran', 'Sakit')->count(),
            'alpha' => (clone $query)->where('status_kehadiran', 'Alpha')->count(),
        ];

        return response()->json($statistics);
    }
}
