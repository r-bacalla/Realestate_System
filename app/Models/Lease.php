<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Lease extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lease_number',
        'property_id',
        'tenant_id',
        'start_date',
        'end_date',
        'monthly_rent',
        'deposit_amount',
        'payment_day',
        'status',
        'terms',
        'signed_at',
    ];

    protected $casts = [
        'start_date'     => 'date',
        'end_date'       => 'date',
        'signed_at'      => 'datetime',
        'monthly_rent'   => 'decimal:2',
        'deposit_amount' => 'decimal:2',
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
    

    // Accessors
    public function getDurationInMonthsAttribute(): int
    {
        return (int) $this->start_date->diffInMonths($this->end_date);
    }

    public function getIsExpiringSoonAttribute(): bool
    {
        return $this->status === 'active'
            && $this->end_date->diffInDays(now()) <= 30
            && $this->end_date->isFuture();
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active'    => 'bg-green-100 text-green-800',
            'expired'   => 'bg-red-100 text-red-800',
            'pending'   => 'bg-yellow-100 text-yellow-800',
            'cancelled' => 'bg-gray-100 text-gray-600',
            default     => 'bg-gray-100 text-gray-600',
        };
    }

    // Boot: auto-generate lease number
    protected static function booted(): void
    {
        static::creating(function (Lease $lease) {
            $lease->lease_number = 'LSE-' . str_pad(
                static::withTrashed()->count() + 1, 4, '0', STR_PAD_LEFT
            );
        });
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function totalPaid()
    {
        return $this->payments()->sum('amount');
    }

    public function balance()
    {
        return $this->monthly_rent * $this->monthsTotal() - $this->totalPaid();
    }
}