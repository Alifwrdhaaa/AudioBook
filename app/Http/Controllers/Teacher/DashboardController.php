<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = auth('teacher')->user();
        if (!$teacher instanceof \App\Models\User) {
            abort(403);
        }
        $totalClasses = $teacher->taughtClasses()->count();
        // Additional stats can be added here

        return view('teacher.dashboard', compact('totalClasses'));
    }
}
