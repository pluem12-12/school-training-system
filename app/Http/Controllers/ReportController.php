<?php

namespace App\Http\Controllers;

use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * แสดงรายการรายงานทั้งหมด (สำหรับอาจารย์/admin)
     */
    public function index()
    {
        $reports = StudentReport::with('student')
            ->latest()
            ->paginate(20);

        return view('reports.index', compact('reports'));
    }

    /**
     * นักศึกษาส่งรายงาน
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'report_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'description' => 'nullable|string|max:1000',
        ]);

        $path = $request->file('report_file')->store('reports', 'public');

        StudentReport::create([
            'student_id' => auth()->id(),
            'title' => $request->title,
            'file_path' => $path,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return back()->with('success', 'ส่งรายงานสำเร็จแล้ว!');
    }

    /**
     * อาจารย์ approve รายงาน
     */
    public function approve(Request $request, StudentReport $report)
    {
        $request->validate([
            'teacher_comment' => 'nullable|string|max:1000',
        ]);

        $report->update([
            'status' => 'approved',
            'teacher_comment' => $request->teacher_comment,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        return back()->with('success', 'อนุมัติรายงานสำเร็จ');
    }

    /**
     * อาจารย์ reject รายงาน
     */
    public function reject(Request $request, StudentReport $report)
    {
        $request->validate([
            'teacher_comment' => 'required|string|max:1000',
        ]);

        $report->update([
            'status' => 'rejected',
            'teacher_comment' => $request->teacher_comment,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        return back()->with('success', 'ส่งกลับรายงานสำเร็จ');
    }
}