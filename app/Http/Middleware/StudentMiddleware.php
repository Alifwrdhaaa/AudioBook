<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Student;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('student_id')) {
            if ($request->hasCookie('remember_student_id')) {
                $studentId = $request->cookie('remember_student_id');
                $student = Student::find($studentId);
                if ($student) {
                    $request->session()->put('student_id', $student->id);
                } else {
                    \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('remember_student_id'));
                    return redirect()->route('student.login');
                }
            } else {
                return redirect()->route('student.login');
            }
        }
        
        $student = Student::find($request->session()->get('student_id'));
        if (!$student) {
            $request->session()->forget('student_id');
            return redirect()->route('student.login');
        }

        // Share student with views
        view()->share('currentStudent', $student);

        return $next($request);
    }
}
