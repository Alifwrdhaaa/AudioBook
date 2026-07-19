<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\SubChapter;

class SubChapterController extends Controller
{
    public function index(Request $request)
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);

        $chapter_id = $request->query('chapter_id');
        
        if (!$chapter_id) {
            $subjects = $teacher->subjects()->with(['chapters', 'schoolClass'])->get();
            return view('teacher.sub_chapters.select_chapter', compact('subjects'));
        }

        $chapter = Chapter::findOrFail($chapter_id);
        
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        $subChapters = $chapter->subChapters()->orderBy('order_number')->get();
        return view('teacher.sub_chapters.index', compact('chapter', 'subChapters'));
    }

    public function create(Request $request)
    {
        $chapter_id = $request->query('chapter_id');
        if (!$chapter_id) {
            return redirect()->route('teacher.chapters.index');
        }

        $chapter = Chapter::findOrFail($chapter_id);
        $teacher = auth('teacher')->user();
        
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.sub_chapters.create', compact('chapter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
            'title' => 'required|string|max:255',
            'order_number' => 'nullable|integer|min:1',
        ]);

        $chapter = Chapter::findOrFail($request->chapter_id);
        $teacher = auth('teacher')->user();
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        $orderNumber = $request->order_number;
        if (!$orderNumber) {
            $lastOrder = SubChapter::where('chapter_id', $chapter->id)->max('order_number');
            $orderNumber = $lastOrder ? $lastOrder + 1 : 1;
        }

        SubChapter::create([
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'order_number' => $orderNumber,
        ]);

        return redirect()->route('teacher.sub_chapters.index', ['chapter_id' => $request->chapter_id])
            ->with('success', 'Sub Judul berhasil ditambahkan.');
    }

    public function edit(SubChapter $subChapter)
    {
        $chapter = $subChapter->chapter;
        $teacher = auth('teacher')->user();
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.sub_chapters.edit', compact('subChapter', 'chapter'));
    }

    public function update(Request $request, SubChapter $subChapter)
    {
        $chapter = $subChapter->chapter;
        $teacher = auth('teacher')->user();
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'order_number' => 'nullable|integer|min:1',
        ]);

        $orderNumber = $request->order_number ?: $subChapter->order_number;

        $subChapter->update([
            'title' => $request->title,
            'order_number' => $orderNumber,
        ]);

        return redirect()->route('teacher.sub_chapters.index', ['chapter_id' => $chapter->id])
            ->with('success', 'Sub Judul berhasil diubah.');
    }

    public function destroy(SubChapter $subChapter)
    {
        $chapter = $subChapter->chapter;
        $teacher = auth('teacher')->user();
        if ($chapter->subject->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        $subChapter->delete();
        return redirect()->route('teacher.sub_chapters.index', ['chapter_id' => $chapter->id])
            ->with('success', 'Sub Judul berhasil dihapus.');
    }
}
