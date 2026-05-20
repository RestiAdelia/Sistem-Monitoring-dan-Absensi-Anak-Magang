<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NilaiAkhirDanSertifikat;
use App\Models\Absensi;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraduationController extends Controller
{
    /**
     * Mentor Dashboard: Show assigned interns and calculate their final grades.
     */
    public function mentorIndex()
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        $interns = $mentor->interns()->with('nilaiAkhirDanSertifikat')->get()->map(function($intern) {
            // 1. Calculate Attendance Rate
            $totalAttendanceDays = Absensi::where('user_id', $intern->id)->count();
            $presentDays = Absensi::where('user_id', $intern->id)->where('status_kehadiran', 'Hadir')->count();
            $attendanceScore = $totalAttendanceDays > 0 ? round(($presentDays / $totalAttendanceDays) * 100) : 0;

            // 2. Calculate Average Task Grade
            $avgTaskGrade = round(PengumpulanTugas::where('user_id', $intern->id)->whereNotNull('nilai')->avg('nilai') ?? 0);

            $intern->calculated_attendance = $attendanceScore;
            $intern->calculated_tasks = $avgTaskGrade;

            return $intern;
        });

        return view('mentor.grading.index', compact('interns'));
    }

    /**
     * Mentor Action: Submit final grading calculation.
     */
    public function mentorGrade(Request $request, User $intern)
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        if ($intern->mentor_id !== $mentor->id) {
            abort(403, 'Intern ini bukan anak bimbingan Anda.');
        }

        $validated = $request->validate([
            'nilai_absensi' => 'required|integer|min:0|max:100',
            'nilai_tugas' => 'required|integer|min:0|max:100',
            'nilai_performa' => 'required|integer|min:0|max:100',
        ]);

        // Formula: 30% Absensi + 40% Tugas + 30% Performa
        $nilaiAkhir = round(
            ($validated['nilai_absensi'] * 0.3) +
            ($validated['nilai_tugas'] * 0.4) +
            ($validated['nilai_performa'] * 0.3)
        );

        NilaiAkhirDanSertifikat::updateOrCreate(
            ['user_id' => $intern->id],
            [
                'nilai_absensi' => $validated['nilai_absensi'],
                'nilai_tugas' => $validated['nilai_tugas'],
                'nilai_performa' => $validated['nilai_performa'],
                'nilai_akhir' => $nilaiAkhir,
            ]
        );

        return redirect()->route('mentor.grading.index')->with('success', 'Nilai akhir anak magang berhasil disimpan.');
    }

    /**
     * Admin Dashboard: Show all graded interns and form to upload certificate PDFs.
     */
    public function adminIndex()
    {
        $interns = User::where('role', 'magang')
            ->with(['mentor', 'nilaiAkhirDanSertifikat'])
            ->get();

        return view('admin.graduation.index', compact('interns'));
    }

    /**
     * Admin Action: Upload certificate PDF.
     */
    public function adminUploadCertificate(Request $request, User $intern)
    {
        $validated = $request->validate([
            'file_sertifikat' => 'required|file|mimes:pdf|max:10240', // max 10MB PDF
        ]);

        $gradeRecord = NilaiAkhirDanSertifikat::where('user_id', $intern->id)->first();
        if (!$gradeRecord) {
            return back()->withErrors(['error' => 'Anak magang belum dinilai oleh mentor. Silakan beri nilai terlebih dahulu.']);
        }

        $filePath = $request->file('file_sertifikat')->store('certificates', 'public');

        $gradeRecord->update([
            'file_sertifikat' => $filePath,
        ]);

        return redirect()->route('admin.graduation.index')->with('success', 'Sertifikat berhasil diunggah.');
    }

    /**
     * Mobile API: Expose PDF download link and scores for the intern.
     * Endpoint: GET /api/certificate
     */
    public function getCertificate()
    {
        $user = Auth::user();
        if ($user->role !== 'magang') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya anak magang yang dapat mengambil sertifikat.'
            ], 403);
        }

        $gradeRecord = NilaiAkhirDanSertifikat::where('user_id', $user->id)->first();

        if (!$gradeRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai akhir dan sertifikat Anda belum diterbitkan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'nilai_absensi' => $gradeRecord->nilai_absensi,
                'nilai_tugas' => $gradeRecord->nilai_tugas,
                'nilai_performa' => $gradeRecord->nilai_performa,
                'nilai_akhir' => $gradeRecord->nilai_akhir,
                'sertifikat_url' => $gradeRecord->file_sertifikat ? asset('storage/' . $gradeRecord->file_sertifikat) : null
            ]
        ]);
    }
}
