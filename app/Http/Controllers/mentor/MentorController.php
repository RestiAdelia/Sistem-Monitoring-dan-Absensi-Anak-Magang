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

        // Mengambil anak magang yang mentor_id-nya adalah ID mentor saat ini
        $myInterns = User::where('role', 'magang')
            ->where('mentor_id', $mentor->id)
            ->with('dataMagang') // Mengambil data instansi & periode magang
            ->orderBy('name')
            ->get();

        return view('mentor.datamagang.index', compact('myInterns'));
    }
}
