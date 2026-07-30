<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Document;
use App\Models\StudentReport;
use App\Models\User;
use App\Models\School;
use App\Models\Announcement;
use App\Models\TrainingSchedule;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var User|null $user */
        $user = $request->user();
        $role = $user?->role ?? 'student';

        switch ($role) {
            case 'admin':
                return $this->adminDashboard();

            case 'teacher':
                return $this->teacherDashboard();

            case 'mentor':
                return $this->mentorDashboard($user);

            default:
                return $this->studentDashboard($user);
        }
    }

    /**
     * Admin Dashboard - แสดงสถิติภาพรวมของระบบ
     */
    private function adminDashboard()
    {
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_mentors' => User::where('role', 'mentor')->count(),
            'total_schools' => School::count(),
            'total_reports' => StudentReport::count(),
            'pending_reports' => StudentReport::where('status', 'pending')->count(),
            'total_evaluations' => Evaluation::count(),
            'total_documents' => Document::count(),
        ];

        $recentReports = StudentReport::with('student')
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        $announcements = Announcement::published()
            ->pinnedFirst()
            ->take(3)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentReports', 'recentUsers', 'announcements'));
    }

    /**
     * Teacher Dashboard - แสดงรายงานนักศึกษาและสถิติ
     */
    private function teacherDashboard()
    {
        $reports = StudentReport::with('student')
            ->latest()
            ->take(10)
            ->get();

        $pendingReports = StudentReport::with('student')
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'total_reports' => $reports->count(),
            'pending_reports' => $pendingReports->count(),
            'approved_reports' => StudentReport::where('status', 'approved')->count(),
            'total_students' => User::where('role', 'student')->count(),
        ];

        $schedules = TrainingSchedule::active()
            ->upcoming()
            ->take(5)
            ->get();

        return view('dashboard.teacher', compact('reports', 'pendingReports', 'stats', 'schedules'));
    }

    /**
     * Mentor Dashboard - แสดงนักศึกษาในความดูแลและผลประเมิน
     */
    private function mentorDashboard(User $user)
    {
        // ผลประเมินที่ครูพี่เลี้ยงเป็นผู้ให้
        $evaluations = Evaluation::with('student')
            ->where('mentor_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // นักศึกษาที่ครูพี่เลี้ยงประเมิน
        $studentIds = $evaluations->pluck('student_id')->unique();
        $students = User::whereIn('id', $studentIds)->get();

        // รายงานของนักศึกษาในความดูแล
        $reports = StudentReport::with('student')
            ->whereIn('student_id', $studentIds)
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'total_students' => $students->count(),
            'total_evaluations' => $evaluations->count(),
            'total_reports' => $reports->count(),
        ];

        $announcements = Announcement::published()
            ->pinnedFirst()
            ->take(3)
            ->get();

        return view('dashboard.mentor', compact('evaluations', 'students', 'reports', 'stats', 'announcements'));
    }

    /**
     * Student Dashboard - แสดงข้อมูลส่วนตัวของนักศึกษา
     */
    private function studentDashboard(User $user)
    {
        $evaluations = Evaluation::where('student_id', $user->id)->latest()->take(5)->get();
        $documents = Document::latest()->take(10)->get();
        $myReports = StudentReport::where('student_id', $user->id)->latest()->take(10)->get();

        // บันทึกการเข้าฝึกสอน
        $todayAttendance = Attendance::where('student_id', $user->id)
            ->today()
            ->first();

        $attendances = Attendance::where('student_id', $user->id)
            ->orderByDesc('date')
            ->take(10)
            ->get();

        // ข่าวประชาสัมพันธ์
        $announcements = Announcement::published()
            ->pinnedFirst()
            ->take(3)
            ->get();

        // ตารางฝึกสอน
        $schedules = TrainingSchedule::active()
            ->upcoming()
            ->take(5)
            ->get();

        return view('dashboard.student', compact(
            'evaluations', 'documents', 'myReports',
            'todayAttendance', 'attendances',
            'announcements', 'schedules'
        ));
    }
}