<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\StudentAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Admin Routes
Route::middleware(['auth:admin', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('teachers', \App\Http\Controllers\Admin\TeacherController::class);
    Route::resource('classes', \App\Http\Controllers\Admin\ClassController::class);
    Route::resource('master-subjects', \App\Http\Controllers\Admin\MasterSubjectController::class);
    Route::resource('subjects', \App\Http\Controllers\Admin\SubjectController::class);
    Route::resource('schedules', \App\Http\Controllers\Admin\ScheduleController::class);
    Route::resource('students', \App\Http\Controllers\Admin\StudentController::class)->only(['index', 'destroy']);
});

// Teacher Routes
Route::middleware(['auth:teacher', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('classes', \App\Http\Controllers\Teacher\ClassController::class);
    Route::resource('subjects', \App\Http\Controllers\Teacher\SubjectController::class);
    Route::resource('schedules', \App\Http\Controllers\Teacher\ScheduleController::class);
    Route::resource('chapters', \App\Http\Controllers\Teacher\ChapterController::class);
    Route::resource('sub_chapters', \App\Http\Controllers\Teacher\SubChapterController::class);
    Route::resource('materials', \App\Http\Controllers\Teacher\MaterialController::class);
    Route::resource('quizzes', \App\Http\Controllers\Teacher\QuizController::class);
    Route::resource('quiz_questions', \App\Http\Controllers\Teacher\QuizQuestionController::class)->except(['index', 'show']);
    Route::get('/progress', [\App\Http\Controllers\Teacher\StudentProgressController::class, 'index'])->name('progress');
    Route::get('/progress/{student}', [\App\Http\Controllers\Teacher\StudentProgressController::class, 'showStudent'])->name('progress.show');
    Route::get('/attempts', [\App\Http\Controllers\Teacher\StudentProgressController::class, 'allAttempts'])->name('attempts.index');
    Route::get('/quizzes/{quiz}/attempts', [\App\Http\Controllers\Teacher\StudentProgressController::class, 'quizAttempts'])->name('quizzes.attempts');
    Route::get('/attempts/{attempt}', [\App\Http\Controllers\Teacher\StudentProgressController::class, 'showAttempt'])->name('attempts.show');
    Route::post('/attempts/{attempt}/grade', [\App\Http\Controllers\Teacher\StudentProgressController::class, 'gradeAttempt'])->name('attempts.grade');
});

// Student Guest Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [StudentAuthController::class, 'login']);
    Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');

    Route::middleware(['student'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/leaderboard', [\App\Http\Controllers\Student\DashboardController::class, 'leaderboard'])->name('leaderboard');
        Route::get('/subjects/{subject}', [\App\Http\Controllers\Student\DashboardController::class, 'showSubject'])->name('subjects.show');
        
        // Course Consumption Routes
        Route::get('/materials/{material}', [\App\Http\Controllers\Student\CourseController::class, 'showMaterial'])->name('materials.show');
        Route::post('/materials/{material}/complete', [\App\Http\Controllers\Student\CourseController::class, 'completeMaterial'])->name('materials.complete');

        // Quiz Routes
        Route::get('/quizzes/{quiz}', [\App\Http\Controllers\Student\QuizController::class, 'show'])->name('quizzes.show');
        Route::post('/quizzes/{quiz}', [\App\Http\Controllers\Student\QuizController::class, 'store'])->name('quizzes.store');
    });
});

Route::middleware('auth:admin,teacher,web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
