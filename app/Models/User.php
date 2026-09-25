<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    // ═══════════════════════════════════════════════════════
    // LABELS ET COULEURS DES RÔLES
    // ═══════════════════════════════════════════════════════

    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'super_admin' => '👑 Super Admin',
            'admin' => '⚙️ Admin',
            'product_manager' => '📦 Gestionnaire Produits',
            'post_manager' => '📰 Gestionnaire Actualités',
            'tender_manager' => '📋 Gestionnaire Appels d\'offres',
            'message_manager' => '📬 Gestionnaire Messages',
            'viewer' => '👁️ Lecteur',
            default => 'Utilisateur',
        };
    }

    public function getRoleColorAttribute(): string
    {
        return match($this->role) {
            'super_admin' => 'purple',
            'admin' => 'blue',
            'product_manager' => 'indigo',
            'post_manager' => 'green',
            'tender_manager' => 'yellow',
            'message_manager' => 'orange',
            'viewer' => 'gray',
            default => 'gray',
        };
    }

    // ═══════════════════════════════════════════════════════
    // PERMISSIONS
    // ═══════════════════════════════════════════════════════

    public function canManageProducts(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'product_manager']);
    }

    public function canManagePosts(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'post_manager']);
    }

    public function canManageTenders(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'tender_manager']);
    }

    public function canManageMessages(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'message_manager']);
    }

    public function canManageUsers(): bool
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
}