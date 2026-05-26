<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_number',
        'property_id',
        'tenant_id',
        'reported_by',
        'title',
        'description',
        'priority',
        'status',
        'estimated_cost',
        'actual_cost',
        'assigned_to',
        'resolved_at',
        'notes',
    ];

    protected $casts = [
        'resolved_at'    => 'datetime',
        'estimated_cost' => 'decimal:2',
        'actual_cost'    => 'decimal:2',
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    // Accessors
    public function getPriorityBadgeAttribute(): string
    {
        return match($this->priority) {
            'urgent' => 'bg-red-100 text-red-800',
            'high'   => 'bg-orange-100 text-orange-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'low'    => 'bg-green-100 text-green-800',
            default  => 'bg-gray-100 text-gray-600',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'     => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'resolved'    => 'bg-green-100 text-green-800',
            'cancelled'   => 'bg-gray-100 text-gray-600',
            default       => 'bg-gray-100 text-gray-600',
        };
    }

    // Boot: auto-generate ticket number
    protected static function booted(): void
    {
        static::creating(function (MaintenanceRequest $req) {
            $req->ticket_number = 'MR-' . str_pad(
                static::withTrashed()->count() + 1, 4, '0', STR_PAD_LEFT
            );
        });
    }
}