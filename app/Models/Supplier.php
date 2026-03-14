<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'contact_person',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'postal_code',
        'tax_number',
        'notes',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function spareparts()
    {
        return $this->hasMany(Sparepart::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->province} {$this->postal_code}";
    }
}
