<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'order_id',
        'status',
        'progress_percentage',
        'started_at',
        'completed_at',
        'expires_at',
        'last_accessed_at',
        'meta_data'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'expires_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'progress_percentage' => 'integer'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function completions()
    {
        return $this->hasMany(LessonCompletion::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    // Methods
    public function updateProgress()
    {
        $totalLessons = $this->course->lessons()->count();
        if ($totalLessons > 0) {
            $completedLessons = $this->completions()->count();
            $this->progress_percentage = ($completedLessons / $totalLessons) * 100;
            $this->save();

            // Check if course is completed
            if ($this->progress_percentage >= 100 && $this->status === 'active') {
                $this->markAsCompleted();
            }
        }
        return $this;
    }

//    public function markAsCompleted()
//    {
//        $this->update([
//            'status' => 'completed',
//            'completed_at' => now(),
//            'progress_percentage' => 100
//        ]);
//
//        event(new CourseCompleted($this));
//    }

    public function recordAccess()
    {
        $this->update([
            'last_accessed_at' => now()
        ]);

        if (!$this->started_at) {
            $this->update([
                'started_at' => now(),
                'status' => 'active'
            ]);
        }
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function canAccess(): bool
    {
        return $this->status === 'active' && !$this->isExpired();
    }
}
