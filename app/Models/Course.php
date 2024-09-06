<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'price',
        'discount',
        'net_price',
        'thumbnail',
        'status',
        'data',
        'parent_id',
        'featured_video'

    ];

    protected $casts = [
        'data' => 'array',
    ];

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
}
