<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'school_class_id', 'teacher_id'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'subject_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'subject_id');
    }
}
