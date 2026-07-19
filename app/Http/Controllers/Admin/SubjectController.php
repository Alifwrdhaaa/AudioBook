<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\User;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with(['schoolClass', 'teacher'])->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        $teachers = User::where('role', 'teacher')->get();
        $masterSubjects = \App\Models\MasterSubject::all();
        return view('admin.subjects.create', compact('classes', 'teachers', 'masterSubjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_class_id' => 'required|exists:school_classes,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function edit(Subject $subject)
    {
        $classes = SchoolClass::all();
        $teachers = User::where('role', 'teacher')->get();
        $masterSubjects = \App\Models\MasterSubject::all();
        return view('admin.subjects.edit', compact('subject', 'classes', 'teachers', 'masterSubjects'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_class_id' => 'required|exists:school_classes,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil diubah.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
