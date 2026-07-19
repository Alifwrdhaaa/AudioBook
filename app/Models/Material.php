<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_chapter_id', 'title', 'order_number', 'content', 'audio_path', 'video_path'
    ];

    public function subChapter()
    {
        return $this->belongsTo(SubChapter::class);
    }
}
