<?php

namespace App\Models;

use App\Models\Stage;
use App\Models\Lesson;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'description',
        'price',
        'discount',
        'net_price',
        'thumbnail',
        'featured_video',
        'status',
        'level',
        'duration_in_minutes',
        'data',
        'parent_id',
        'category_id',
        'stage_id',
        'instructor_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'net_price' => 'decimal:2',
        'average_rating' => 'decimal:2',
        'data' => 'array',
    ];
    /**
     * @var int|mixed
     */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = Str::slug($course->title);
        });
    }

    public function parent()
    {
        return $this->belongsTo(Course::class, 'parent_id');
    }
    public function parents()
    {
        return  $this->parent ? $this->parent->parents()->merge($this->parent) : collect();
    }
    public function parentsArray()
    {
        // return $this->parents()->pluck('id')->toArray();
        $parents = [];
        $current = $this->parent;

        while ($current) {
            $parents[] = $current;
            $current = $current->parent;
        }
        return array_reverse($parents);
    }

    public function children()
    {
        return $this->hasMany(Course::class, 'parent_id')->orderBy('id', 'desc');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
    public function scopePublished($query)
    {
        return $query->where('status', 'active');
    }

    public function calculateNetPrice(): static
    {
        $this->net_price = $this->price - ($this->discount ?? 0);
        return $this;
    }

    public function updateTotalLessons(): void
    {
        $this->total_lessons = $this->lessons()->count();
        $this->save();
    }

}
