<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentProgressController extends Controller
{
    public function index()
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        // Get classes taught by teacher
        $classes = $teacher->taughtClasses()->with(['students.progresses', 'students.quizAttempts'])->get();

        return view('teacher.progress.index', compact('classes'));
    }

    public function showStudent(\App\Models\Student $student)
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);

        // Ensure this student belongs to a class taught by the teacher
        $isMyStudent = $teacher->taughtClasses()->where('school_classes.id', $student->class_id)->exists();
        if (!$isMyStudent) {
            abort(403);
        }

        // Load subjects taught by this teacher to this class
        $subjects = \App\Models\Subject::where('teacher_id', $teacher->id)
            ->where('school_class_id', $student->class_id)
            ->with(['chapters.subChapters.materials', 'chapters.subChapters.quizzes'])
            ->get();

        $student->load(['progresses', 'quizAttempts.quiz']);

        return view('teacher.progress.show', compact('student', 'subjects'));
    }

    public function allAttempts()
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);

        $attempts = \App\Models\QuizAttempt::whereHas('quiz.subChapter.chapter.subject', function($q) use ($teacher) {
            $q->where('teacher_id', $teacher->id);
        })->with(['student', 'quiz.subChapter.chapter.subject.schoolClass'])->latest()->get();

        return view('teacher.progress.all_attempts', compact('attempts'));
    }

    public function quizAttempts(\App\Models\Quiz $quiz)
    {
        $chapter = $quiz->subChapter->chapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $attempts = \App\Models\QuizAttempt::where('quiz_id', $quiz->id)->with('student')->latest()->get();

        return view('teacher.progress.quiz_attempts', compact('quiz', 'attempts'));
    }

    public function showAttempt(\App\Models\QuizAttempt $attempt)
    {
        $chapter = $attempt->quiz->subChapter->chapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $attempt->load(['student', 'quiz.questions', 'answers.question']);

        return view('teacher.progress.grade', compact('attempt'));
    }

    public function gradeAttempt(Request $request, \App\Models\QuizAttempt $attempt)
    {
        $chapter = $attempt->quiz->subChapter->chapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        // Usually quizzes are auto-graded, but if teacher needs to override:
        $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
            'answers' => 'nullable|array',
            'answers.*.is_correct' => 'required|in:0,1',
            'answers.*.teacher_note' => 'nullable|string',
        ]);

        $isPassed = $request->score >= $attempt->quiz->passing_score;
        $isFirstTimeGrading = $attempt->score === null;

        $attempt->update([
            'score' => $request->score,
            'is_passed' => $isPassed,
            'feedback' => $request->feedback,
        ]);

        if ($request->has('answers')) {
            foreach ($request->answers as $answerId => $data) {
                $answer = \App\Models\QuizAttemptAnswer::where('id', $answerId)
                    ->where('quiz_attempt_id', $attempt->id)
                    ->first();
                
                if ($answer) {
                    $answer->update([
                        'is_correct' => $data['is_correct'],
                        'teacher_note' => $data['teacher_note']
                    ]);
                }
            }
        }

        if ($isFirstTimeGrading) {
            $student = $attempt->student;
            $student->increment('xp', $isPassed ? 50 : 10);
        }

        return redirect()->route('teacher.attempts.index')->with('success', 'Nilai dan catatan berhasil disimpan.');
    }
}
