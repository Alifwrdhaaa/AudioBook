<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::find($request->session()->get('student_id'));
        
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        
        // Determine today's day name in Indonesian
        $dayMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        $todayEnglish = date('l');
        $activeDay = $request->query('day', $dayMap[$todayEnglish] ?? 'Senin');
        
        if (!in_array($activeDay, $days)) {
            $activeDay = 'Senin';
        }

        // Get schedules for this student's class for the active day
        $schedules = Schedule::where('school_class_id', $student->class_id)
            ->where('day_of_week', $activeDay)
            ->with('subject.teacher')
            ->get();

        return view('student.dashboard', compact('student', 'days', 'activeDay', 'schedules'));
    }

    public function showSubject(Request $request, Subject $subject)
    {
        $student = Student::find($request->session()->get('student_id'));
        
        // Ensure subject belongs to student's class
        if ($subject->school_class_id !== $student->class_id) {
            abort(403);
        }

        $subject->load(['chapters' => function($q) {
            $q->orderBy('order_number')->with(['subChapters' => function($sc) {
                $sc->orderBy('order_number')->with(['materials' => function($m) {
                    $m->orderBy('order_number');
                }, 'quizzes' => function($qz) {
                    $qz->where('is_published', true);
                }]);
            }]);
        }]);

        $progresses = \App\Models\Progress::where('student_id', $student->id)->get()->keyBy('material_id');

        return view('student.subject', compact('student', 'subject', 'progresses'));
    }

    public function leaderboard(Request $request)
    {
        $student = Student::find($request->session()->get('student_id'));

        // Get all students in the same class, ordered by XP desc, then streak desc
        $students = Student::where('class_id', $student->class_id)
            ->orderBy('xp', 'desc')
            ->orderBy('streak', 'desc')
            ->get();

        return view('student.leaderboard', compact('student', 'students'));
    }
}
