<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_code', 'name', 'class_id', 'attendance_number',
        'avatar', 'xp', 'level', 'streak'
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'student_badges');
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
    
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
