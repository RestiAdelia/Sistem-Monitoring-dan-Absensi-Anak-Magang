<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
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
        $user = Auth::user();
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
            'foto_bukti' => 'nullable|image|max:2048', // max 2MB
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
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        $internIds = $mentor->interns()->pluck('id');

        $logbooks = Logbook::whereIn('user_id', $internIds)
            ->with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('mentor.logbooks.index', compact('logbooks'));
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
}
