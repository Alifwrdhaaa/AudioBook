<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    
    protected $table = 'progress';

    protected $fillable = [
        'student_id', 'chapter_id', 'material_id', 'progress_percentage', 'is_completed', 'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
