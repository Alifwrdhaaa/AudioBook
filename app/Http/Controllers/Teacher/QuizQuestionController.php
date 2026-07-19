<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function create(Request $request)
    {
        $quiz_id = $request->query('quiz_id');
        $type = $request->query('type', 'multiple_choice');

        if (!$quiz_id) return redirect()->back();

        $quiz = \App\Models\Quiz::findOrFail($quiz_id);
        $subChapter = $quiz->subChapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        return view('teacher.quiz_questions.create', compact('quiz', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_type' => 'required|in:multiple_choice,true_false,essay',
            'question' => 'required|string',
        ]);

        $quiz = \App\Models\Quiz::findOrFail($request->quiz_id);
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($quiz->subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $question = \App\Models\QuizQuestion::create([
            'quiz_id' => $quiz->id,
            'question_type' => $request->question_type,
            'question' => $request->question,
        ]);

        if ($request->question_type === 'multiple_choice') {
            $request->validate([
                'options' => 'required|array|min:2',
                'options.*' => 'required|string',
                'correct_option' => 'required|integer|min:0',
            ]);

            foreach ($request->options as $index => $option_text) {
                \App\Models\QuizOption::create([
                    'question_id' => $question->id,
                    'option_text' => $option_text,
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }
        } else if ($request->question_type === 'true_false') {
            $request->validate([
                'correct_answer' => 'required|in:true,false',
            ]);

            \App\Models\QuizOption::create([
                'question_id' => $question->id,
                'option_text' => 'Benar',
                'is_correct' => ($request->correct_answer === 'true'),
            ]);
            \App\Models\QuizOption::create([
                'question_id' => $question->id,
                'option_text' => 'Salah',
                'is_correct' => ($request->correct_answer === 'false'),
            ]);
        }

        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(\App\Models\QuizQuestion $quiz_question)
    {
        $quiz = $quiz_question->quiz;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($quiz->subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $quiz_question->load('options');
        return view('teacher.quiz_questions.edit', compact('quiz_question', 'quiz'));
    }

    public function update(Request $request, \App\Models\QuizQuestion $quiz_question)
    {
        $quiz = $quiz_question->quiz;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($quiz->subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $request->validate([
            'question' => 'required|string',
        ]);

        $quiz_question->update([
            'question' => $request->question,
        ]);

        // Remove old options and recreate them to simplify update logic
        $quiz_question->options()->delete();

        if ($quiz_question->question_type === 'multiple_choice') {
            $request->validate([
                'options' => 'required|array|min:2',
                'options.*' => 'required|string',
                'correct_option' => 'required|integer|min:0',
            ]);

            foreach ($request->options as $index => $option_text) {
                \App\Models\QuizOption::create([
                    'question_id' => $quiz_question->id,
                    'option_text' => $option_text,
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }
        } else if ($quiz_question->question_type === 'true_false') {
            $request->validate([
                'correct_answer' => 'required|in:true,false',
            ]);

            \App\Models\QuizOption::create([
                'question_id' => $quiz_question->id,
                'option_text' => 'Benar',
                'is_correct' => ($request->correct_answer === 'true'),
            ]);
            \App\Models\QuizOption::create([
                'question_id' => $quiz_question->id,
                'option_text' => 'Salah',
                'is_correct' => ($request->correct_answer === 'false'),
            ]);
        }

        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(\App\Models\QuizQuestion $quiz_question)
    {
        $quiz = $quiz_question->quiz;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        if ($quiz->subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $quiz_question->delete();
        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Soal berhasil dihapus.');
    }
}
