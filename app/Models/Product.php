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
        'approval_status', 'approved_by', 'approved_at', 'rejection_reason',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'approved_at' => 'datetime',
    ];

    // ═══════════════════════════════════════════════════════
    // RELATIONS
    // ═══════════════════════════════════════════════════════
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // ═══════════════════════════════════════════════════════
    // LOCALE ACCESSORS
    // ═══════════════════════════════════════════════════════
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

    // ═══════════════════════════════════════════════════════
    // PUBLICATION SCOPES
    // ═══════════════════════════════════════════════════════
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // ═══════════════════════════════════════════════════════
    // APPROVAL SCOPES
    // ═══════════════════════════════════════════════════════
    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('approval_status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('approval_status', 'rejected');
    }

    // ═══════════════════════════════════════════════════════
    // APPROVAL ACCESSORS
    // ═══════════════════════════════════════════════════════
    public function getApprovalLabelAttribute(): string
    {
        return match($this->approval_status) {
            'pending'  => '⏳ En attente',
            'approved' => '✅ Approuvé',
            'rejected' => '❌ Rejeté',
            default    => '❓ Inconnu',
        };
    }

    public function getApprovalColorAttribute(): string
    {
        return match($this->approval_status) {
            'pending'  => 'yellow',
            'approved' => 'green',
            'rejected' => 'red',
            default    => 'gray',
        };
    }

    public function getIsApprovedAttribute(): bool
    {
        return $this->approval_status === 'approved';
    }
}