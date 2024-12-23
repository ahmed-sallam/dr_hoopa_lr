<?php

namespace App\Models;

use App\Models\Course;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'description',
        'is_premium',
        'thumbnail',
        'content_url',
        'status',
        'content_type',
        'order',
        'duration',
        'data',
        'course_id',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'data' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lesson) {
            $lesson->slug = Str::slug($lesson->title);
        });

        static::saved(function ($lesson) {
            $lesson->course->updateTotalLessons();
        });
    }

    // Relationships
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function completion(): HasOne
    {
        return $this->hasOne(LessonCompletion::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Methods
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function markAsCompleted($userId)
    {
        $completion = $this->completion()->updateOrCreate(
            ['user_id' => $userId],
            ['completed_at' => now()]
        );

        if ($completion->wasRecentlyCreated) {
            $this->increment('completions_count');
        }
    }

    public function getDurationForHumans()
    {
        return CarbonInterval::seconds($this->duration)->cascade()->forHumans();
    }

    public function getSecureVideoUrl()
    {
        if ($this->content_type !== 'video') {
            return null;
        }
        
        if (!auth()->check() || !Gate::allows('view', $this)) {
            return null;
        }

        // Convert YouTube URL to embed format and add security parameters
        $url = str_replace('watch?v=', 'embed/', $this->content_url);
        return $url . '?origin=' . config('app.url') 
               . '&amp;iv_load_policy=3'
               . '&amp;modestbranding=1'
               . '&amp;playsinline=1'
               . '&amp;showinfo=0'
               . '&amp;rel=0'
               . '&amp;enablejsapi=1'
               . '&amp;controls=0'
               . '&amp;autohide=1'
               . '&amp;wmode=transparent';
    }

    public function canBeViewedByUser(?User $user = null): bool
    {
        if (!$user) {
            return !$this->is_premium;
        }

        return Gate::allows('view', $this);
    }
}
