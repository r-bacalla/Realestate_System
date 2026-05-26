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
        'password',
        'role',
        'phone',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    // Role helpers
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }

    public function isTenant(): bool
    {
        return $this->role === 'tenant';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Relationships
    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    public function reportedMaintenance()
    {
        return $this->hasMany(MaintenanceRequest::class, 'reported_by');
    }

    // Badge
    public function getRoleBadgeAttribute(): string
    {
        return match($this->role) {
            'admin'  => 'bg-purple-100 text-purple-800',
            'agent'  => 'bg-blue-100 text-blue-800',
            'tenant' => 'bg-green-100 text-green-800',
            default  => 'bg-gray-100 text-gray-600',
        };
    }
}