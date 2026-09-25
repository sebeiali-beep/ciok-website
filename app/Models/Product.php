<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name_fr', 'name_ar', 'name_en',
        'slug',
        'description_fr', 'description_ar', 'description_en',
        'specifications_fr', 'specifications_ar', 'specifications_en',
        'image',
        'is_featured', 'is_active', 'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"name_{$locale}"} ?? $this->name_fr;
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"description_{$locale}"} ?? $this->description_fr;
    }

    public function getSpecificationsAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"specifications_{$locale}"} ?? $this->specifications_fr;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}