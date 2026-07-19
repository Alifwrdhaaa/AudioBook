<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_chapter_id', 'title', 'passing_score', 'max_attempt', 
        'is_random_questions', 'is_random_answers', 'is_published'
    ];

    public function subChapter()
    {
        return $this->belongsTo(SubChapter::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
