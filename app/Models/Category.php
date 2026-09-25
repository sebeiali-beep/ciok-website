<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_fr', 'name_ar', 'name_en',
        'slug',
        'description_fr', 'description_ar', 'description_en',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Nom traduit selon la locale active
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
}