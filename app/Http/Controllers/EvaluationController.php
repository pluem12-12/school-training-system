<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EvaluationQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Step 1: Select Type
     */
    public function selectType()
    {
        return view('evaluations.type');
    }

    /**
     * Step 2: Show Search Student Form
     */
    public function searchStudent(Request $request)
    {
        $type = $request->query('type');
        if (!$type) {
            return redirect()->route('evaluations.type')->with('error', 'กรุณาเลือกประเภทการประเมิน');
        }

        // Store selected type in session
        session(['evaluation_type' => $type]);

        return view('evaluations.search');
    }

    /**
     * Step 2.5: Process Search Student Form
     */
    public function postSearchStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
        ]);

        $student = User::where('role', 'student')->where('student_id', $request->student_id)->first();

        if (!$student) {
            return back()->with('error', 'ไม่พบข้อมูลนักศึกษารหัส: ' . $request->student_id);
        }

        return redirect()->route('evaluations.verify', ['student_id' => $student->id]);
    }

    /**
     * Step 3: Verify Student Info
     */
    public function verifyStudent($student_id)
    {
        $student = User::with('memberProfile')->where('role', 'student')->findOrFail($student_id);
        
        return view('evaluations.verify', compact('student'));
    }

    /**
     * Step 4: Show Evaluation Form
     */
    public function createForm($student_id)
    {
        $student = User::where('role', 'student')->findOrFail($student_id);
        $type = session('evaluation_type');

        if (!$type) {
            return redirect()->route('evaluations.type')->with('error', 'กรุณาเริ่มขั้นตอนการประเมินใหม่');
        }

        // Fetch dynamic questions from database
        $questions = EvaluationQuestion::where('is_active', true)
            ->orderBy('sort_order')
            ->pluck('question_text', 'id')
            ->toArray();

        if (empty($questions)) {
            return redirect()->route('dashboard')->with('error', 'ยังไม่มีการตั้งหัวข้อการประเมิน กรุณาติดต่อผู้ดูแลระบบ');
        }

        return view('evaluations.form', compact('student', 'type', 'questions'));
    }

    /**
     * Step 4.5: Store Evaluation Score
     */
    public function storeScore(Request $request, $student_id)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|integer|min:1|max:5',
        ]);

        $type = session('evaluation_type');
        if (!$type) {
            return redirect()->route('evaluations.type');
        }

        $scores = $request->scores;
        $totalScore = array_sum($scores);

        // Create Evaluation Record
        $evaluation = Evaluation::create([
            'type' => $type,
            'student_id' => $student_id,
            'mentor_id' => Auth::id(), // Can be mentor or teacher
            'score' => $totalScore,
            'scores_data' => $scores,
        ]);

        return redirect()->route('evaluations.feedback', ['evaluation_id' => $evaluation->id]);
    }

    /**
     * Step 5: Show Feedback Form
     */
    public function feedbackForm($evaluation_id)
    {
        $evaluation = Evaluation::where('mentor_id', Auth::id())->findOrFail($evaluation_id);
        $student = User::findOrFail($evaluation->student_id);

        return view('evaluations.feedback', compact('evaluation', 'student'));
    }

    /**
     * Step 5.5: Store Feedback
     */
    public function storeFeedback(Request $request, $evaluation_id)
    {
        $request->validate([
            'comment' => 'nullable|string|max:1000',
        ]);

        $evaluation = Evaluation::where('mentor_id', Auth::id())->findOrFail($evaluation_id);
        $evaluation->update([
            'comment' => $request->comment,
        ]);

        // Clear session
        session()->forget('evaluation_type');

        return redirect()->route('dashboard')->with('success', 'บันทึกผลการประเมินเรียบร้อยแล้ว');
    }
}
