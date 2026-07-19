<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubChapter extends Model
{
    protected $fillable = [
        'chapter_id',
        'title',
        'order_number',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class)->orderBy('order_number');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
