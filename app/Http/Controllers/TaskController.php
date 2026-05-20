<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Web View: List of tasks dispatched by the mentor and student submissions.
     */
    public function index()
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        $tasks = Tugas::where('mentor_id', $mentor->id)->withCount('pengumpulanTugas')->get();

        // Get submissions from interns assigned to this mentor
        $internIds = $mentor->interns()->pluck('id');
        $submissions = PengumpulanTugas::whereIn('user_id', $internIds)
            ->with(['tugas', 'user'])
            ->orderBy('waktu_kumpul', 'desc')
            ->get();

        return view('mentor.tasks.index', compact('tasks', 'submissions'));
    }

    /**
     * Web View: Store a newly dispatched task by a mentor.
     */
    public function store(Request $request)
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'judul_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'required|string',
            'file_materi' => 'nullable|file|max:5120', // max 5MB
            'deadline' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $filePath = null;
        if ($request->hasFile('file_materi')) {
            $filePath = $request->file('file_materi')->store('tasks', 'public');
        }

        Tugas::create([
            'mentor_id' => $mentor->id,
            'judul_tugas' => $validated['judul_tugas'],
            'deskripsi_tugas' => $validated['deskripsi_tugas'],
            'file_materi' => $filePath,
            'deadline' => Carbon::parse($validated['deadline']),
        ]);

        return redirect()->route('mentor.tasks.index')->with('success', 'Tugas berhasil dibuat dan dikirim ke anak magang.');
    }

    /**
     * Web View: Grade an intern's submission.
     */
    public function gradeSubmission(Request $request, PengumpulanTugas $submission)
    {
        $mentor = Auth::user();
        if ($mentor->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        // Verify if submission belongs to an intern of this mentor
        if ($submission->user->mentor_id !== $mentor->id) {
            abort(403, 'Anda tidak berhak memberikan nilai untuk pengumpulan ini.');
        }

        $validated = $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'catatan_nilai' => 'nullable|string',
        ]);

        $submission->update($validated);

        return redirect()->route('mentor.tasks.index')->with('success', 'Nilai tugas berhasil disimpan.');
    }

    /**
     * Mobile API: Fetch tasks dispatched by the intern's mentor.
     * Endpoint: GET /api/tasks
     */
    public function getTasks()
    {
        $user = Auth::user();
        if ($user->role !== 'magang') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya anak magang yang dapat mengambil tugas.'
            ], 403);
        }

        if (!$user->mentor_id) {
            return response()->json([
                'success' => true,
                'message' => 'Anda belum diplot ke mentor mana pun.',
                'data' => []
            ]);
        }

        // Retrieve tasks from the intern's mentor
        $tasks = Tugas::where('mentor_id', $user->mentor_id)->get()->map(function($task) use ($user) {
            // Check if the student has already submitted
            $submission = PengumpulanTugas::where('tugas_id', $task->id)
                ->where('user_id', $user->id)
                ->first();

            $task->is_submitted = !empty($submission);
            $task->submission = $submission;
            return $task;
        });

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    /**
     * Mobile API: Submit task answer.
     * Endpoint: POST /api/tasks/{id}/submit
     */
    public function submitTask(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'magang') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya anak magang yang dapat mengumpulkan tugas.'
            ], 403);
        }

        $task = Tugas::findOrFail($id);

        // Check if task deadline has passed
        if (Carbon::now()->greaterThan($task->deadline)) {
            return response()->json([
                'success' => false,
                'message' => 'Batas waktu pengumpulan tugas ini sudah terlewati.'
            ], 422);
        }

        // Check if already submitted
        $existing = PengumpulanTugas::where('tugas_id', $task->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah mengumpulkan tugas ini.'
            ], 422);
        }

        $validated = $request->validate([
            'file_jawaban' => 'required|file|max:10240', // max 10MB
        ]);

        $filePath = $request->file('file_jawaban')->store('submissions', 'public');

        $submission = PengumpulanTugas::create([
            'tugas_id' => $task->id,
            'user_id' => $user->id,
            'file_jawaban' => $filePath,
            'waktu_kumpul' => Carbon::now(),
            'nilai' => null,
            'catatan_nilai' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil dikumpulkan.',
            'data' => $submission
        ], 201);
    }
}
