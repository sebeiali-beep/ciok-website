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
    ];

    protected $casts = [
        'deadline_date' => 'date',
        'opening_date' => 'date',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
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

    // Type lisible
    public function getTypeLabelAttribute()
    {
        return $this->type === 'appel_offre' ? 'Appel d\'offres' : 'Consultation élargie';
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
}