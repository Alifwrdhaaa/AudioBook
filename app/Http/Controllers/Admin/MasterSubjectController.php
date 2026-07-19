<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterSubject;

class MasterSubjectController extends Controller
{
    public function index()
    {
        $subjects = MasterSubject::paginate(10);
        return view('admin.master_subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.master_subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:master_subjects,name',
        ]);

        MasterSubject::create($request->only(['name']));

        return redirect()->route('admin.master-subjects.index')->with('success', 'Master Pelajaran berhasil ditambahkan.');
    }

    public function edit(MasterSubject $masterSubject)
    {
        return view('admin.master_subjects.edit', compact('masterSubject'));
    }

    public function update(Request $request, MasterSubject $masterSubject)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:master_subjects,name,' . $masterSubject->id,
        ]);

        $masterSubject->update($request->only(['name']));

        return redirect()->route('admin.master-subjects.index')->with('success', 'Master Pelajaran berhasil diperbarui.');
    }

    public function destroy(MasterSubject $masterSubject)
    {
        $masterSubject->delete();
        return redirect()->route('admin.master-subjects.index')->with('success', 'Master Pelajaran berhasil dihapus.');
    }
}
