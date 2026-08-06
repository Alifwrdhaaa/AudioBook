<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Support\Str;

class StudentAuthController extends Controller
{
    public function showLogin()
    {
        $classes = SchoolClass::has('teachers')->get();
        return view('student.auth.login', compact('classes'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:school_classes,id',
            'attendance_number' => 'required|string|max:10',
        ]);

        $schoolClass = SchoolClass::findOrFail($request->class_id);
        
        // Validation 1: Capacity check
        if ($request->attendance_number > $schoolClass->max_students) {
            return back()->withErrors(['attendance_number' => 'Nomor absen tidak boleh melebihi kapasitas kelas (' . $schoolClass->max_students . ')!']);
        }
        
        // Generate student code based on class name and attendance number
        // e.g. X RPL 1 and 12 => XRPL1-12
        $classPrefix = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $schoolClass->name));
        $formattedNumber = str_pad($request->attendance_number, 2, '0', STR_PAD_LEFT);
        $studentCode = $classPrefix . '-' . $formattedNumber;

        // Validation 2: Anti-hijacking check
        $existingStudent = Student::where('student_code', $studentCode)->first();
        if ($existingStudent) {
            if (strtolower(trim($existingStudent->name)) !== strtolower(trim($request->name))) {
                return back()->withErrors(['attendance_number' => 'Hayo harus sesuai absen nya yaa! Absen ini sudah dipakai oleh temanmu.']);
            }
            $student = $existingStudent;
        } else {
            // Create new student
            $student = Student::create([
                'student_code' => $studentCode,
                'name' => $request->name,
                'class_id' => $request->class_id,
                'attendance_number' => $request->attendance_number,
                'xp' => 0,
                'level' => 1,
                'streak' => 0,
            ]);
        }

        // Clear any existing teacher/admin sessions
        \Illuminate\Support\Facades\Auth::guard('web')->logout();
        \Illuminate\Support\Facades\Auth::guard('admin')->logout();
        \Illuminate\Support\Facades\Auth::guard('teacher')->logout();

        // Store in session
        $request->session()->put('student_id', $student->id);
        
        // Set permanent cookie (5 years) to prevent logout
        \Illuminate\Support\Facades\Cookie::queue('remember_student_id', $student->id, 2628000);

        return redirect()->route('student.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('student_id');
        \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('remember_student_id'));
        return redirect()->route('student.login');
    }
}
