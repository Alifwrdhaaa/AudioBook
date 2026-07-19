<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);

        $sub_chapter_id = $request->query('sub_chapter_id');
        
        if (!$sub_chapter_id) {
            return redirect()->route('teacher.materials.index');
        }

        $subChapter = \App\Models\SubChapter::findOrFail($sub_chapter_id);
        
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $quizzes = $subChapter->quizzes()->get();
        return view('teacher.quizzes.index', compact('subChapter', 'quizzes'));
    }

    public function create(Request $request)
    {
        $sub_chapter_id = $request->query('sub_chapter_id');
        if (!$sub_chapter_id) {
            return redirect()->route('teacher.materials.index');
        }

        $subChapter = \App\Models\SubChapter::findOrFail($sub_chapter_id);
        
        if ($subChapter->chapter->subject->teacher_id !== auth('teacher')->id()) {
            abort(403);
        }
        
        return view('teacher.quizzes.create', compact('subChapter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_chapter_id' => 'required|exists:sub_chapters,id',
            'title' => 'required|string|max:255',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempt' => 'required|integer|min:1',
        ]);

        $subChapter = \App\Models\SubChapter::findOrFail($request->sub_chapter_id);
        if ($subChapter->chapter->subject->teacher_id !== auth('teacher')->id()) {
            abort(403);
        }

        $quiz = \App\Models\Quiz::create([
            'sub_chapter_id' => $request->sub_chapter_id,
            'title' => $request->title,
            'passing_score' => $request->passing_score,
            'max_attempt' => $request->max_attempt,
            'is_random_questions' => $request->has('is_random_questions'),
            'is_random_answers' => $request->has('is_random_answers'),
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Kuis berhasil dibuat. Silakan tambahkan soal.');
    }

    public function show(\App\Models\Quiz $quiz)
    {
        $subChapter = $quiz->subChapter;
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        
        if ($subChapter->chapter->subject->teacher_id !== $teacher->id) {
            abort(403);
        }

        $quiz->load('questions.options');
        return view('teacher.quizzes.show', compact('quiz', 'subChapter'));
    }

    public function edit(\App\Models\Quiz $quiz)
    {
        $subChapter = $quiz->subChapter;
        
        if ($subChapter->chapter->subject->teacher_id !== auth('teacher')->id()) {
            abort(403);
        }

        return view('teacher.quizzes.edit', compact('quiz', 'subChapter'));
    }

    public function update(Request $request, \App\Models\Quiz $quiz)
    {
        $subChapter = $quiz->subChapter;
        
        if ($subChapter->chapter->subject->teacher_id !== auth('teacher')->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempt' => 'required|integer|min:1',
        ]);

        $quiz->update([
            'title' => $request->title,
            'passing_score' => $request->passing_score,
            'max_attempt' => $request->max_attempt,
            'is_random_questions' => $request->has('is_random_questions'),
            'is_random_answers' => $request->has('is_random_answers'),
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id])
            ->with('success', 'Pengaturan kuis berhasil diubah.');
    }

    public function destroy(\App\Models\Quiz $quiz)
    {
        $subChapter = $quiz->subChapter;
        
        if ($subChapter->chapter->subject->teacher_id !== auth('teacher')->id()) {
            abort(403);
        }

        $quiz->delete();
        return redirect()->route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id])
            ->with('success', 'Kuis berhasil dihapus.');
    }
}
