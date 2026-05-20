<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GraduationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Dynamic dashboard redirect based on role
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.users.index');
    } elseif ($user->role === 'mentor') {
        return redirect()->route('mentor.attendance.index');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin dashboards (CRUD, Assignment/Plotting, Certificate uploads)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::post('users/{intern}/assign-mentor', [UserController::class, 'assignMentor'])->name('users.assign-mentor');
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    Route::get('graduation', [GraduationController::class, 'adminIndex'])->name('graduation.index');
    Route::post('graduation/{intern}/certificate', [GraduationController::class, 'adminUploadCertificate'])->name('graduation.upload-certificate');
});

// Mentor dashboards (Attendance view, Logbook approval, Tasks distribution/grading, Graduation check)
Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    
    Route::get('logbooks', [LogbookController::class, 'index'])->name('logbooks.index');
    Route::post('logbooks/{logbook}/status', [LogbookController::class, 'updateStatus'])->name('logbooks.update-status');
    
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('tasks/{submission}/grade', [TaskController::class, 'gradeSubmission'])->name('tasks.grade');
    
    Route::get('grading', [GraduationController::class, 'mentorIndex'])->name('grading.index');
    Route::post('grading/{intern}/grade', [GraduationController::class, 'mentorGrade'])->name('grading.submit');
});

require __DIR__.'/auth.php';
