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
        'pdf',
        'is_published', 'published_at',
        'approval_status', 'approved_by', 'approved_at', 'rejection_reason',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    // ═══════════════════════════════════════════════════════
    // LOCALE ACCESSORS (title, excerpt, content)
    // ═══════════════════════════════════════════════════════
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

    // ═══════════════════════════════════════════════════════
    // PUBLICATION SCOPE
    // ═══════════════════════════════════════════════════════
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now());
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
    // APPROVAL RELATION
    // ═══════════════════════════════════════════════════════
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
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