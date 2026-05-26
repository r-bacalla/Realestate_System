<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'property_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'id_type',
        'id_number',
        'emergency_contact',
        'emergency_phone',
        'status',
        'notes',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    public function activeLeases()
    {
        return $this->hasMany(Lease::class)->where('status', 'active');
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active'   => 'bg-green-100 text-green-800',
            'inactive' => 'bg-gray-100 text-gray-600',
            'evicted'  => 'bg-red-100 text-red-800',
            default    => 'bg-gray-100 text-gray-600',
        };
    }
}