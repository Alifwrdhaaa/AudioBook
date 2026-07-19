<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $majors = \App\Models\Major::all();
        $classes = \App\Models\SchoolClass::all();
        return view('admin.teachers.create', compact('majors', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:Aktif,Nonaktif',
            'majors' => 'array',
            'classes' => 'array',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $profilePath = null;
        $backgroundPath = null;

        if ($request->hasFile('profile_photo')) {
            $profilePath = $request->file('profile_photo')->store('teachers/profiles', 'public');
        }
        if ($request->hasFile('background_photo')) {
            $backgroundPath = $request->file('background_photo')->store('teachers/backgrounds', 'public');
        }

        $teacher = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'teacher',
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'status' => $request->status,
            'profile_photo' => $profilePath,
            'background_photo' => $backgroundPath,
        ]);

        if ($request->has('majors')) {
            $teacher->majors()->sync($request->majors);
        }

        if ($request->has('classes')) {
            $teacher->taughtClasses()->sync($request->classes);
        }

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit(User $teacher)
    {
        $majors = \App\Models\Major::all();
        $classes = \App\Models\SchoolClass::all();
        $teacher->load('majors', 'taughtClasses');
        return view('admin.teachers.edit', compact('teacher', 'majors', 'classes'));
    }

    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$teacher->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:Aktif,Nonaktif',
            'majors' => 'array',
            'classes' => 'array',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone_number = $request->phone_number;
        $teacher->gender = $request->gender;
        $teacher->status = $request->status;

        if ($request->filled('password')) {
            $teacher->password = bcrypt($request->password);
        }
        
        if ($request->hasFile('profile_photo')) {
            $teacher->profile_photo = $request->file('profile_photo')->store('teachers/profiles', 'public');
        }
        if ($request->hasFile('background_photo')) {
            $teacher->background_photo = $request->file('background_photo')->store('teachers/backgrounds', 'public');
        }

        $teacher->save();

        if ($request->has('majors')) {
            $teacher->majors()->sync($request->majors);
        } else {
            $teacher->majors()->sync([]);
        }

        if ($request->has('classes')) {
            $teacher->taughtClasses()->sync($request->classes);
        } else {
            $teacher->taughtClasses()->sync([]);
        }

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
