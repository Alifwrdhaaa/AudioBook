<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        // Get schedules for subjects taught by this teacher
        $schedules = Schedule::whereHas('subject', function($q) {
            $q->where('teacher_id', Auth::id());
        })->with(['schoolClass', 'subject'])->orderBy('school_class_id')->orderBy('day_of_week')->paginate(20);
        
        return view('teacher.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        $subjects = Subject::where('teacher_id', Auth::id())->get();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return view('teacher.schedules.create', compact('classes', 'subjects', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'day_of_week' => 'required|string',
        ]);

        // Verify subject belongs to teacher
        $subject = Subject::findOrFail($request->subject_id);
        if ($subject->teacher_id !== Auth::id()) abort(403);

        Schedule::create($request->all());

        return redirect()->route('teacher.schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        if ($schedule->subject->teacher_id !== Auth::id()) abort(403);
        
        $classes = SchoolClass::all();
        $subjects = Subject::where('teacher_id', Auth::id())->get();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return view('teacher.schedules.edit', compact('schedule', 'classes', 'subjects', 'days'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule->subject->teacher_id !== Auth::id()) abort(403);

        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'day_of_week' => 'required|string',
        ]);

        $subject = Subject::findOrFail($request->subject_id);
        if ($subject->teacher_id !== Auth::id()) abort(403);

        $schedule->update($request->all());

        return redirect()->route('teacher.schedules.index')->with('success', 'Jadwal berhasil diubah.');
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->subject->teacher_id !== Auth::id()) abort(403);
        $schedule->delete();
        return redirect()->route('teacher.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
