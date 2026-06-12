<?php

use App\Http\Controllers\Admin\AdminDashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'mentor') {
        return redirect()->route('mentor.dashboard');
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
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/statistics', [AdminDashboardController::class, 'getStatistics'])->name('dashboard.statistics');
    Route::resource('users', UserController::class);
    Route::post('users/{intern}/assign-mentor', [UserController::class, 'assignMentor'])->name('users.assign-mentor');
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');
    Route::get('absensi-anak-magang', [AdminDashboardController::class, 'adminAbsensiIndex'])->name('absensi.index');
    Route::get('graduation', [GraduationController::class, 'adminIndex'])->name('graduation.index');
    Route::post('graduation/{intern}/certificate', [GraduationController::class, 'adminUploadCertificate'])->name('graduation.upload-certificate');
    Route::get('data-anak-magang', [InternDataController::class, 'index'])->name('data-anak-magang.index');
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
    Route::get('/admin/absensi/persetujuan', [AttendanceController::class, 'pendingApprovals'])->name('absensi.pending');
    Route::post('/admin/absensi/approve/{id}', [AttendanceController::class, 'approveReject'])->name('absensi.action');
    Route::get('/daftar-pengajuan', [AttendanceController::class, 'daftarPengajuanAdmin'])->name('absensi.pengajuan');
});

// Mentor dashboards (Attendance view, Logbook approval, Tasks distribution/grading, Graduation check)
Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('dashboard', [MentorController::class, 'dashboard'])->name('dashboard');
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('logbooks', [LogbookController::class, 'index'])->name('logbooks.index');
    Route::get('logbooks/{userId}', [LogbookController::class, 'showInternLogbooks'])->name('logbooks.show');
    Route::patch('/logbooks/{logbook}', [LogbookController::class, 'updateStatus'])
        ->name('logbooks.update');
    Route::post('logbooks/{logbook}/status', [LogbookController::class, 'updateStatus'])->name('logbooks.update-status');
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('tasks/{id}/detail', [TaskController::class, 'showTaskDetail'])->name('tasks.showTaskDetail');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('tasks/{submission}/grade', [TaskController::class, 'gradeSubmission'])->name('tasks.grade');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('grading', [GraduationController::class, 'mentorIndex'])->name('grading.index');
    Route::post('grading/{intern}/grade', [GraduationController::class, 'mentorGrade'])->name('grading.submit');
    Route::get('/my-interns', [MentorController::class, 'interns'])->name('interns.index');
});

require __DIR__ . '/auth.php';
