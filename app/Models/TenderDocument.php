<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenderDocument extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'file_path',
        'icon', 'badge_label', 'order', 'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }
}