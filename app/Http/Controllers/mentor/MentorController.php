<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    public function dashboard()
    {
        $mentor = Auth::user();

        // 1. Total Interns assigned to this mentor
        $internsCount = User::where('role', 'magang')
            ->where('mentor_id', $mentor->id)
            ->count();

        // 2. Today's Attendance for these interns
        $internIds = User::where('role', 'magang')
            ->where('mentor_id', $mentor->id)
            ->pluck('id');
        
        $todayAttendanceCount = \App\Models\Absensi::whereIn('user_id', $internIds)
            ->whereDate('tanggal', today())
            ->count();

        // 3. Pending Logbooks to approve
        $pendingLogbooksCount = \App\Models\Logbook::whereIn('user_id', $internIds)
            ->where('status_approval', 'Pending')
            ->count();

        // 4. Submissions to grade
        $pendingSubmissionsCount = \App\Models\PengumpulanTugas::whereIn('user_id', $internIds)
            ->whereNull('nilai')
            ->count();

        // 5. Recent Attendance (Last 5)
        $recentAttendance = \App\Models\Absensi::whereIn('user_id', $internIds)
            ->with('user')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->limit(5)
            ->get();

        // 6. Recent Logbooks (Last 5)
        $recentLogbooks = \App\Models\Logbook::whereIn('user_id', $internIds)
            ->with('user')
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('mentor.dashboard', compact(
            'internsCount',
            'todayAttendanceCount',
            'pendingLogbooksCount',
            'pendingSubmissionsCount',
            'recentAttendance',
            'recentLogbooks'
        ));
    }

    public function interns()
    {
        $mentor = Auth::user();

        // Mengambil anak magang yang mentor_id-nya adalah ID mentor saat ini
        $myInterns = User::where('role', 'magang')
            ->where('mentor_id', $mentor->id)
            ->with('dataMagang') // Mengambil data instansi & periode magang
            ->orderBy('name')
            ->get();

        return view('mentor.datamagang.index', compact('myInterns'));
    }
}
