<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GraduationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

// Public mobile API login to issue Sanctum tokens
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Kredensial yang diberikan salah.'
        ], 422);
    }

    if ($user->role !== 'magang') {
        return response()->json([
            'success' => false,
            'message' => 'Akses ditolak. Hanya anak magang yang diizinkan masuk melalui mobile.'
        ], 403);
    }

    if (!$user->is_active) {
        return response()->json([
            'success' => false,
            'message' => 'Akun Anda telah dinonaktifkan oleh administrator.'
        ], 403);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json([
        'success' => true,
        'token' => $token,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'nomor_induk' => $user->nomor_induk,
            'instansi' => $user->instansi,
            'mentor_id' => $user->mentor_id,
        ]
    ]);
});

// Protected mobile API routes (Sanctum + Role check)
Route::middleware(['auth:sanctum', 'role:magang'])->group(function () {
    // Geofenced Attendance
    Route::post('/absen', [AttendanceController::class, 'submitAttendance']);
     Route::get('/absen/today', [AttendanceController::class, 'today']);
    Route::get('/absen/summary', [AttendanceController::class, 'summary']); 
    // Logbook submission
    Route::post('/logbook', [LogbookController::class, 'submitLogbook']);
    
    // Task lists and submission
    Route::get('/tasks', [TaskController::class, 'getTasks']);
    Route::post('/tasks/{id}/submit', [TaskController::class, 'submitTask']);
    
    // Certificate download and final grades
    Route::get('/certificate', [GraduationController::class, 'getCertificate']);
});
