<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Chapter;
use App\Models\Quiz;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_students' => Student::count(),
            'total_classes' => SchoolClass::count(),
            'total_chapters' => Chapter::count(),
            'total_quizzes' => Quiz::count(),
        ];
        
        $topStudents = Student::orderBy('xp', 'desc')->take(10)->get();

        return view('admin.dashboard', compact('stats', 'topStudents'));
    }
}
