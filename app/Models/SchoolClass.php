<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_students'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'school_class_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'school_class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'school_class_user')->withTimestamps();
    }
}
