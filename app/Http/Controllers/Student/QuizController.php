<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Progress;
use App\Models\Student;

class QuizController extends Controller
{
    private function areMaterialsCompleted($studentId, $subChapterId)
    {
        $subChapter = \App\Models\SubChapter::findOrFail($subChapterId);
        $totalMaterials = $subChapter->materials()->count();
        if ($totalMaterials === 0) return true;

        // Progress model doesn't store sub_chapter_id, but it stores material_id.
        // We can check if all materials in the subchapter are completed.
        $materialIds = $subChapter->materials()->pluck('id');
        
        $completedProgress = Progress::where('student_id', $studentId)
            ->whereIn('material_id', $materialIds)
            ->where('is_completed', true)
            ->count();

        return $completedProgress >= $totalMaterials;
    }

    public function show(Request $request, Quiz $quiz)
    {
        $student = Student::find($request->session()->get('student_id'));
        if (!$student) abort(403);

        if (!$this->areMaterialsCompleted($student->id, $quiz->sub_chapter_id)) {
            return redirect()->route('student.subjects.show', $quiz->subChapter->chapter->subject_id)
                ->with('error', 'Anda harus menyelesaikan semua materi di sub judul ini sebelum mengikuti kuis.');
        }

        // Check if already attempted
        $existingAttempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existingAttempt) {
            $quiz->load('questions.options');
            $existingAttempt->load('answers.question');
            return view('student.quizzes.show', compact('quiz', 'student', 'existingAttempt'));
        }

        $quiz->load('questions.options');
        return view('student.quizzes.show', compact('quiz', 'student'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $student = Student::find($request->session()->get('student_id'));
        if (!$student) abort(403);

        if (!$this->areMaterialsCompleted($student->id, $quiz->sub_chapter_id)) {
            abort(403, 'Materials not completed');
        }

        // Grade the quiz
        $questions = $quiz->questions;
        $totalQuestions = $questions->count();
        $correctAnswers = 0;

        $hasEssay = false;
        $totalQuestions = $questions->count();
        $correctAnswers = 0;
        
        $answersData = [];

        if ($totalQuestions > 0) {
            foreach ($questions as $question) {
                $userAnswer = $request->input('q_' . $question->id);
                
                $answersData[] = [
                    'quiz_question_id' => $question->id,
                    'answer_text' => $userAnswer,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if ($question->question_type === 'essay') {
                    $hasEssay = true;
                } else {
                    $correctOption = $question->options()->where('is_correct', true)->first();
                    if ($correctOption && $userAnswer == $correctOption->id) {
                        $correctAnswers++;
                    }
                }
            }
        }

        // Auto-grade if there are no essay questions
        if (!$hasEssay) {
            // Calculate score
            $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;
            $isPassed = $score >= $quiz->passing_score;
        } else {
            // Wait for teacher grading
            $score = null;
            $isPassed = false;
        }

        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'student_id' => $student->id,
            'score' => $score,
            'is_passed' => $isPassed,
            'attempt_number' => 1
        ]);

        // Save answers
        foreach ($answersData as &$data) {
            $data['quiz_attempt_id'] = $attempt->id;
        }
        if (!empty($answersData)) {
            \App\Models\QuizAttemptAnswer::insert($answersData);
        }

        if (!$hasEssay) {
            // Auto award XP
            $student->increment('xp', $isPassed ? 50 : 10);
            return redirect()->route('student.subjects.show', $quiz->subChapter->chapter->subject_id)
                ->with('success', 'Kuis selesai! Cek hasil belajarmu sekarang.');
        } else {
            return redirect()->route('student.subjects.show', $quiz->subChapter->chapter->subject_id)
                ->with('success', 'Kuis selesai! Jawaban Anda telah dikirim dan menunggu penilaian dari guru.');
        }
    }
}
