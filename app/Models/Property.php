<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'type',
        'address',
        'city',
        'province',
        'price',
        'status',
        'bedrooms',
        'bathrooms',
        'area_sqm',
        'description',
        'about',
        'year_built',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function images()
    {
        return $this->hasMany(\App\Models\PropertyImage::class);
    }

    public function getFormattedPriceAttribute()
    {
        return '₱' . number_format($this->price, 0);
    }

    public function getExcerptAttribute()
    {
        return Str::limit($this->description, 100);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'available' => 'bg-green-100 text-green-700',
            'rented' => 'bg-blue-100 text-blue-700',
            'sold' => 'bg-red-100 text-red-700',
            'maintenance' => 'bg-yellow-100 text-yellow-700',
            default => 'bg-gray-100 text-gray-700'
        };
    }
}