<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function spareparts()
    {
        return $this->hasMany(Sparepart::class);
    }

    public function getSparepartsCountAttribute()
    {
        return $this->spareparts()->count();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
