<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    public function index()
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        $classes = $teacher->taughtClasses()->paginate(10);
        return view('teacher.classes.index', compact('classes'));
    }

    public function create()
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        // Get classes not yet taught by this teacher
        $availableClasses = SchoolClass::whereNotIn('id', $teacher->taughtClasses()->pluck('school_classes.id'))->get();
        return view('teacher.classes.create', compact('availableClasses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',
        ]);

        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        $teacher->taughtClasses()->attach($request->class_id);

        return redirect()->route('teacher.classes.index')->with('success', 'Kelas berhasil ditambahkan ke daftar mengajar Anda.');
    }

    public function edit(SchoolClass $class)
    {
        // Teachers cannot edit the class name, they can only add/remove from their taught classes.
        abort(403, 'Akses ditolak.');
    }

    public function update(Request $request, SchoolClass $class)
    {
        abort(403, 'Akses ditolak.');
    }

    public function destroy(SchoolClass $class)
    {
        $teacher = auth('teacher')->user();
        assert($teacher instanceof \App\Models\User);
        $teacher->taughtClasses()->detach($class->id);
        return redirect()->route('teacher.classes.index')->with('success', 'Kelas berhasil dihapus dari daftar mengajar Anda.');
    }
}
