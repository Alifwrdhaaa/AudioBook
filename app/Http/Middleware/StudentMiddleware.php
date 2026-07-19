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
            return redirect()->route('student.login');
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
