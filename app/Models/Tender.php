<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $fillable = [
        'type',
        'reference',
        'title_fr', 'title_ar', 'title_en',
        'slug',
        'description_fr', 'description_ar', 'description_en',
        'deadline_date', 'deadline_time',
        'opening_date', 'opening_time',
        'notice_pdf', 'result_pdf',
        'status',
        'is_published', 'published_at',
         'approval_status', 'approved_by', 'approved_at', 'rejection_reason',
    ];

    protected $casts = [
        'deadline_date' => 'date',
        'opening_date' => 'date',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'approved_at' => 'datetime',
    ];

    // Nom traduit
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?? $this->title_fr;
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"description_{$locale}"} ?? $this->description_fr;
    }

   public function getTypeLabelAttribute()
{
    return match($this->type) {
        'appel_offre'          => 'Appel d\'offres',
        'consultation'         => 'Consultation',
        'consultation_elargie' => 'Consultation élargie',
        default                => 'Type inconnu',
    };
}

public function getTypeColorAttribute()
{
    return match($this->type) {
        'appel_offre'          => 'blue',
        'consultation'         => 'purple',
        'consultation_elargie' => 'pink',
        default                => 'gray',
    };
}

    // Statut lisible
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'open' => 'Ouvert',
            'closed' => 'Clôturé',
            'awarded' => 'Attribué',
            default => 'Inconnu',
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'open' => 'green',
            'closed' => 'gray',
            'awarded' => 'blue',
            default => 'gray',
        };
    }

    // Est-il encore ouvert ?
    public function getIsOpenAttribute()
    {
        if (!$this->deadline_date) return false;
        return now()->lessThan($this->deadline_date->endOfDay());
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open')
                     ->where('deadline_date', '>=', now());
    }

        // ═══ APPROVAL SCOPES ═══
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

    // ═══ APPROVAL RELATION ═══
    public function approver()
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    // ═══ APPROVAL ACCESSORS ═══
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