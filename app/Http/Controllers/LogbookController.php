<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\User;
use App\Models\DataAnakMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    /**
     * Mobile API: Submit daily logbook.
     * Endpoint: POST /api/logbook
     */
    public function submitLogbook(Request $request)
    {
        // $user = Auth::user();
        // $user->load('DataAnakMagang'); // Pastikan relasi DataAnakMagang sudah dimuat
        // if ($user->role !== 'magang') {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Hanya anak magang yang dapat mengumpulkan logbook.'
        //     ], 403);
        // }

        $user = Auth::user();
        // 🔥 PERBAIKAN 1: Huruf awal harus kecil 'dataMagang' sesuai di model User.php
        $user->load('dataMagang');

        if ($user->role !== 'magang') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya anak magang yang dapat mengumpulkan logbook.'
            ], 403);
        }

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'judul_aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_bukti' => 'nullable|image|max:10240', // max 2MB
        ]);

        // Check if logbook already exists for this date
        $existingLogbook = Logbook::where('user_id', $user->id)
            ->where('tanggal', $validated['tanggal'])
            ->first();

        if ($existingLogbook) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah mengumpulkan logbook untuk tanggal tersebut.'
            ], 422);
        }

        $filePath = null;
        if ($request->hasFile('foto_bukti')) {
            $filePath = $request->file('foto_bukti')->store('logbooks', 'public');
        }

        $logbook = Logbook::create([
            'user_id' => $user->id,
            'tanggal' => $validated['tanggal'],
            'judul_aktivitas' => $validated['judul_aktivitas'],
            'deskripsi' => $validated['deskripsi'],
            'foto_bukti' => $filePath,
            'status_approval' => 'Pending',
            'catatan_mentor' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Logbook berhasil dikirim dan menunggu persetujuan mentor.',
            'data' => $logbook
        ], 201);
    }

    /**
     * Web Dashboard: View pending logs, approve, or reject them.
     */

   public function index()
{
    $mentor = Auth::user();
    if ($mentor->role !== 'mentor') abort(403);

    // Kita filter berdasarkan relasi 'dataMagang'
    $interns = $mentor->interns()
        ->whereHas('dataMagang', function ($query) {
            // Gunakan kolom 'status_magang' dari tabel data_anak_magang
            $query->where('status_magang', 'berjalan');
        })
        ->with('dataMagang') // Memuat relasi agar tidak query berkali-kali
        ->withCount('logbooks')
        ->paginate(10);

    return view('mentor.logbooks.index', compact('interns'));
}
    public function showInternLogbooks(Request $request, $userId)
    {
        $mentor = Auth::user();
        $intern = User::findOrFail($userId);

        if ($mentor->role !== 'mentor' || $intern->mentor_id != $mentor->id) {
            abort(403, 'Anda tidak berhak melihat data ini.');
        }

        $query = Logbook::where('user_id', $userId);

        // 🔥 FILTER RENTANG WAKTU (WEB)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        } else {
            // Default 6 Hari Terakhir (termasuk hari ini)
            $query->where('tanggal', '>=', now()->subDays(5));
        }

        $logbooks = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mentor.logbooks.show', compact('logbooks', 'intern'));
    }

    /**
     * Web Dashboard: Approve or Reject a logbook.
     */
    public function updateStatus(Request $request, Logbook $logbook)
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        // Verify if the logbook belongs to one of this mentor's interns
        if ($logbook->user->mentor_id !== $mentor->id) {
            abort(403, 'Anda tidak berhak memperbarui logbook ini.');
        }

        $validated = $request->validate([
            'status_approval' => 'required|in:Disetujui,Ditolak',
            'catatan_mentor' => 'nullable|string',
        ]);

        $logbook->update($validated);

        return redirect()->route('mentor.logbooks.index')->with('success', 'Status logbook berhasil diperbarui.');
    }

    public function getLogbooks(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'magang') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $query = Logbook::where('user_id', $user->id);

        // 🔥 FILTER RENTANG WAKTU (FLUTTER)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        } else {
            // Default 6 Hari Terakhir (termasuk hari ini)
            $query->where('tanggal', '>=', now()->subDays(5));
        }

        $logbooks = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(50); // Angka dibesarkan agar bisa memuat data rentang waktu yang lebar

        return response()->json([
            'success' => true,
            'data' => $logbooks
        ], 200);
    }
}
