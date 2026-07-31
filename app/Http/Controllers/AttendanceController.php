<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * แสดงประวัติการเข้าฝึกสอน
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $attendances = Attendance::where('student_id', $user->id)
            ->orderByDesc('date')
            ->paginate(20);

        $todayAttendance = Attendance::where('student_id', $user->id)
            ->today()
            ->first();

        // สถิติแบบ query เดียวเพื่อลดภาระฐานข้อมูล
        $attendanceStats = Attendance::where('student_id', $user->id)
            ->selectRaw("
                count(*) as total_days,
                sum(case when status = 'present' then 1 else 0 end) as present_days,
                sum(case when status = 'absent' then 1 else 0 end) as absent_days,
                sum(case when status = 'late' then 1 else 0 end) as late_days
            ")->first();

        $stats = [
            'total_days' => $attendanceStats->total_days ?? 0,
            'present_days' => $attendanceStats->present_days ?? 0,
            'absent_days' => $attendanceStats->absent_days ?? 0,
            'late_days' => $attendanceStats->late_days ?? 0,
        ];

        return view('attendance.index', compact('attendances', 'todayAttendance', 'stats'));
    }

    /**
     * Check-in เข้าฝึกสอน
     */
    public function checkIn(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $today = now()->toDateString();

        // ตรวจสอบว่า check-in แล้วหรือยัง
        $existing = Attendance::where('student_id', $user->id)
            ->where('date', $today)
            ->first();

        if ($existing) {
            return back()->with('error', 'คุณได้ลงเวลาเข้าฝึกสอนวันนี้แล้ว');
        }

        Attendance::create([
            'student_id' => $user->id,
            'date' => $today,
            'status' => 'present',
            'check_in_time' => now()->format('H:i:s'),
            'note' => $request->note,
        ]);

        return back()->with('success', 'ลงเวลาเข้าฝึกสอนสำเร็จ');
    }

    /**
     * Check-out ออกจากฝึกสอน
     */
    public function checkOut(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $today = now()->toDateString();

        $attendance = Attendance::where('student_id', $user->id)
            ->where('date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'คุณยังไม่ได้ลงเวลาเข้าฝึกสอนวันนี้');
        }

        if ($attendance->check_out_time) {
            return back()->with('error', 'คุณได้ลงเวลาออกแล้ว');
        }

        $attendance->update([
            'check_out_time' => now()->format('H:i:s'),
        ]);

        return back()->with('success', 'ลงเวลาออกจากฝึกสอนสำเร็จ');
    }

    /**
     * แสดงหน้าแบบฟอร์มใบลาสำหรับปรินท์/โหลด PDF
     */
    public function leaveForm()
    {
        return view('forms.leave-form');
    }

    /**
     * แสดงหน้าแบบฟอร์มใบลา (การฝึกประสบการณ์วิชาชีพครู) สำหรับปรินท์/โหลด PDF
     */
    public function leaveFormInternship()
    {
        return view('forms.leave-form-internship');
    }
}
