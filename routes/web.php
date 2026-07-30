<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// ===== หน้าแรก (Public) =====
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// ===== Routes สำหรับผู้ที่ login แล้ว =====
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (ทุก role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ข่าวประชาสัมพันธ์ (ทุก role)
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');

    // ปฏิทินการฝึก (ทุก role)
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // ดาวน์โหลดเอกสาร (ทุก role)
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

    // ===== นักศึกษา =====
    Route::middleware('role:student')->group(function () {
        // ส่งรายงาน
        Route::post('/submit-report', [ReportController::class, 'store'])->name('reports.store');

        // บันทึกการเข้าฝึกสอน
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkIn');
        Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkOut');
        
        // ใบลา
        Route::get('/attendance/leave-form', [AttendanceController::class, 'leaveForm'])->name('attendance.leave-form');
        Route::get('/attendance/leave-form-internship', [AttendanceController::class, 'leaveFormInternship'])->name('attendance.leave-form-internship');
    });

    // ===== อาจารย์ & Admin =====
    Route::middleware('role:teacher,admin')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::post('/reports/{report}/approve', [ReportController::class, 'approve'])->name('reports.approve');
        Route::post('/reports/{report}/reject', [ReportController::class, 'reject'])->name('reports.reject');
    });

    // ===== ประเมินนักศึกษา (อาจารย์ & ครูพี่เลี้ยง) =====
    Route::middleware('role:teacher,mentor')->group(function () {
        Route::get('/evaluate/type', [EvaluationController::class, 'selectType'])->name('evaluations.type');
        Route::get('/evaluate/search', [EvaluationController::class, 'searchStudent'])->name('evaluations.search');
        Route::post('/evaluate/search', [EvaluationController::class, 'postSearchStudent'])->name('evaluations.search.post');
        Route::get('/evaluate/verify/{student_id}', [EvaluationController::class, 'verifyStudent'])->name('evaluations.verify');
        Route::get('/evaluate/form/{student_id}', [EvaluationController::class, 'createForm'])->name('evaluations.form');
        Route::post('/evaluate/store/{student_id}', [EvaluationController::class, 'storeScore'])->name('evaluations.store');
        Route::get('/evaluate/feedback/{evaluation_id}', [EvaluationController::class, 'feedbackForm'])->name('evaluations.feedback');
        Route::post('/evaluate/feedback/{evaluation_id}', [EvaluationController::class, 'storeFeedback'])->name('evaluations.feedback.store');
    });
});

// ===== Profile (Auth) =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';