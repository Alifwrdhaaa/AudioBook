<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id', 'title', 'description', 'thumbnail', 'order_number', 'is_published'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function subChapters()
    {
        return $this->hasMany(SubChapter::class)->orderBy('order_number');
    }
}
