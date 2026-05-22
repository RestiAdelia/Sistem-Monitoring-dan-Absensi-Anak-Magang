<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\InternDataController;
use App\Http\Controllers\mentor\MentorController;
use App\Http\Controllers\MentorDataController;
use App\Models\DataAnakMagang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

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
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');

    Route::get('graduation', [GraduationController::class, 'adminIndex'])->name('graduation.index');
    Route::post('graduation/{intern}/certificate', [GraduationController::class, 'adminUploadCertificate'])->name('graduation.upload-certificate');
    Route::get('data-anak-magang', function () {
        $interns = DataAnakMagang::with('mentor')->orderBy('nama')->get();
        return view('admin.data-anak-magang.index', compact('interns'));
    })->name('data-anak-magang.index');

    Route::get('data-mentor/create', [MentorDataController::class, 'create'])->name('data-mentor.create');
    Route::get('data-mentor/index', [MentorDataController::class, 'index'])->name('data-mentor.index');
    Route::post('data-mentor', [MentorDataController::class, 'store'])->name('data-mentor.store');
    Route::get('data-anak-magang/create', [InternDataController::class, 'create'])->name('data-anak-magang.create');
    Route::post('data-anak-magang', [InternDataController::class, 'store'])->name('data-anak-magang.store');
    Route::get('data-anak-magang/{id}/edit', [InternDataController::class, 'edit'])->name('data-anak-magang.edit');
    Route::put('data-anak-magang/{id}', [InternDataController::class, 'update'])->name('data-anak-magang.update');
    Route::delete('data-anak-magang/{id}', [InternDataController::class, 'destroy'])->name('data-anak-magang.destroy');
    Route::get('data-mentor/{data_mentor}/edit', [MentorDataController::class, 'edit'])->name('data-mentor.edit');
    Route::put('data-mentor/{data_mentor}', [MentorDataController::class, 'update'])->name('data-mentor.update');
    Route::delete('data-mentor/{data_mentor}', [MentorDataController::class, 'destroy'])->name('data-mentor.destroy');
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

    Route::get('/my-mentor', [MentorController::class, 'dashboard'])->name('interns.index');
});

require __DIR__ . '/auth.php';
