<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('teacher_id', auth()->id())->get();
        $chapters = Chapter::whereIn('subject_id', $subjects->pluck('id'))->get();
        return view('teacher.chapters.index', compact('chapters', 'subjects'));
    }

    public function create()
    {
        $subjects = Subject::where('teacher_id', auth()->id())->get();
        return view('teacher.chapters.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_number' => 'required|integer',
            'is_published' => 'boolean',
        ]);

        // Verify that the subject belongs to this teacher
        $subject = Subject::findOrFail($request->subject_id);
        if ($subject->teacher_id !== auth()->id()) abort(403);

        Chapter::create([
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'order_number' => $request->order_number,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('teacher.chapters.index')->with('success', 'Bab berhasil dibuat.');
    }

    public function edit(Chapter $chapter)
    {
        if ($chapter->subject->teacher_id !== auth()->id()) abort(403);
        $subjects = Subject::where('teacher_id', auth()->id())->get();
        return view('teacher.chapters.edit', compact('chapter', 'subjects'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        if ($chapter->subject->teacher_id !== auth()->id()) abort(403);

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_number' => 'required|integer',
            'is_published' => 'boolean',
        ]);

        $subject = Subject::findOrFail($request->subject_id);
        if ($subject->teacher_id !== auth()->id()) abort(403);

        $chapter->update([
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'order_number' => $request->order_number,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('teacher.chapters.index')->with('success', 'Bab berhasil diubah.');
    }

    public function destroy(Chapter $chapter)
    {
        if ($chapter->subject->teacher_id !== auth()->id()) abort(403);
        $chapter->delete();
        return redirect()->route('teacher.chapters.index')->with('success', 'Bab berhasil dihapus.');
    }
}
