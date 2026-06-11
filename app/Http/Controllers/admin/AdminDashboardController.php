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
    $mentors = DataMentor::where('status_akun', 'Aktif')->with('userAccount')->orderBy('nama')->get();

    $query = Absensi::with(['user.dataMagang.mentor.dataMentor']);

    $query->whereDate('tanggal', today());

    // Filter Mentor
    if ($request->filled('mentor_id')) {
        $mentorData = DataMentor::find($request->mentor_id);
        if ($mentorData && $mentorData->userAccount) {
            $internIds = DataAnakMagang::where('mentor_id', $mentorData->userAccount->id)->pluck('id');
            $userIds = User::whereIn('data_magang_id', $internIds)->pluck('id');
            $query->whereIn('user_id', $userIds);
        }
    }

    // Filter Search
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('nomor_induk', 'like', "%{$search}%");
        });
    }

    // Eksekusi query
    $attendanceRecords = $query->orderBy('jam_masuk', 'desc')
                               ->paginate(10);

    // 2. Statistik 
    $totalInterns = DataAnakMagang::where('status_akun', 'Aktif')->count();
    $totalMentors = DataMentor::where('status_akun', 'Aktif')->count();

    // Statistik Hari Ini
    $todayAttendance = Absensi::whereDate('tanggal', today())->count();

    $attendanceByStatus = Absensi::whereDate('tanggal', today())
        ->selectRaw('status_kehadiran, COUNT(*) as count')
        ->groupBy('status_kehadiran')
        ->pluck('count', 'status_kehadiran');

    return view('admin.dashboard', compact(
        'attendanceRecords',
        'mentors',
        'totalInterns',
        'totalMentors',
        'todayAttendance',
        'attendanceByStatus'
    ));
}
    public function adminAbsensiIndex()
    {
        //data keseluruhan absensi 
        $absensis = Absensi::with([
            'user.dataMagang.mentor.dataMentor'
        ])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->paginate(10);

        // Mengarahkan ke file view admin/absensi/index.blade.php yang kita buat kemarin
        return view('admin.absensi.index', compact('absensis'));
    }
}
