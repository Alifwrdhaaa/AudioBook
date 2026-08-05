<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('teacher_id', Auth::id())->with('schoolClass')->paginate(10);
        return view('teacher.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        $classes = $teacher->taughtClasses()->get();
        $masterSubjects = \App\Models\MasterSubject::all();
        return view('teacher.subjects.create', compact('classes', 'masterSubjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_class_id' => 'required|exists:school_classes,id',
        ]);

        Subject::create([
            'name' => $request->name,
            'school_class_id' => $request->school_class_id,
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('teacher.subjects.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function edit(Subject $subject)
    {
        if ($subject->teacher_id !== auth()->id()) {
            abort(403);
        }
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        $classes = $teacher->taughtClasses()->get();
        $masterSubjects = \App\Models\MasterSubject::all();
        return view('teacher.subjects.edit', compact('subject', 'classes', 'masterSubjects'));
    }

    public function update(Request $request, Subject $subject)
    {
        if ($subject->teacher_id !== Auth::id()) abort(403);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'school_class_id' => 'required|exists:school_classes,id',
        ]);

        $subject->update($request->only(['name', 'school_class_id']));

        return redirect()->route('teacher.subjects.index')->with('success', 'Mata Pelajaran berhasil diubah.');
    }

    public function destroy(Subject $subject)
    {
        if ($subject->teacher_id !== Auth::id()) abort(403);
        $subject->delete();
        return redirect()->route('teacher.subjects.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
