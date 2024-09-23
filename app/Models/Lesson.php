<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'is_premium',
        'thumbnail',
        'content_url',
        'status',
        'order',
        // 'duration',
        'data',
        'course_id',
        'content_type'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
