<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title_fr', 'title_ar', 'title_en',
        'slug',
        'excerpt_fr', 'excerpt_ar', 'excerpt_en',
        'content_fr', 'content_ar', 'content_en',
        'image',
        'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?? $this->title_fr;
    }

    public function getExcerptAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"excerpt_{$locale}"} ?? $this->excerpt_fr;
    }

    public function getContentAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"content_{$locale}"} ?? $this->content_fr;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now());
    }
}