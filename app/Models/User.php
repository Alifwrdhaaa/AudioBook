<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Major[] $majors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SchoolClass[] $schoolClasses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SchoolClass[] $taughtClasses
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
        'background_photo',
        'phone_number',
        'gender',
        'subject',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function majors()
    {
        return $this->belongsToMany(Major::class)->withTimestamps();
    }

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class, 'teacher_id');
    }

    public function taughtClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'school_class_user')->withTimestamps();
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }
}
