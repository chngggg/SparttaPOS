<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sparepart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'barcode',
        'name',
        'slug',
        'category_id',
        'supplier_id',
        'brand',
        'brand_type',
        'model',
        'unit',
        'stock',
        'min_stock',
        'max_stock',
        'purchase_price',
        'selling_price',
        'discount',
        'description',
        'location_rack',
        'image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    protected $appends = ['stock_status', 'profit_margin', 'stock_status_label', 'brand_type_label', 'brand_type_color'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function barcodes()
    {
        return $this->hasMany(Barcode::class);
    }

    public function stockOpnames()
    {
        return $this->hasMany(StockOpname::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * Get stock status as string (out_of_stock, low_stock, over_stock, normal)
     */
    public function getStockStatusAttribute()
    {
        if ($this->stock <= 0) {
            return 'out_of_stock';
        } elseif ($this->stock <= $this->min_stock) {
            return 'low_stock';
        } elseif ($this->max_stock && $this->stock >= $this->max_stock) {
            return 'over_stock';
        }
        return 'normal';
    }

    /**
     * Get stock status label and color for display
     */
    public function getStockStatusLabelAttribute(): array
    {
        return match ($this->stock_status) {
            'out_of_stock' => ['label' => 'Stok Habis', 'color' => 'red'],
            'low_stock' => ['label' => 'Stok Menipis', 'color' => 'yellow'],
            'over_stock' => ['label' => 'Stok Berlebih', 'color' => 'blue'],
            default => ['label' => 'Stok Normal', 'color' => 'green'],
        };
    }

    /**
     * Get brand type label for display
     */
    public function getBrandTypeLabelAttribute(): string
    {
        return match ($this->brand_type) {
            'viar' => 'Viar Original',
            'non-viar' => 'Non-Viar',
            'optional' => 'Aksesoris Optional',
            default => 'Unknown',
        };
    }

    /**
     * Get brand type color for display
     */
    public function getBrandTypeColorAttribute(): string
    {
        return match ($this->brand_type) {
            'viar' => 'bg-emas text-sogan',
            'non-viar' => 'bg-blue-500 text-white',
            'optional' => 'bg-purple-500 text-white',
            default => 'bg-gray-500 text-white',
        };
    }

    public function getProfitMarginAttribute()
    {
        if ($this->purchase_price > 0) {
            $profit = $this->selling_price - $this->purchase_price;
            return round(($profit / $this->purchase_price) * 100, 2);
        }
        return 0;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'min_stock');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk brand type
    public function scopeViar($query)
    {
        return $query->where('brand_type', 'viar');
    }

    public function scopeNonViar($query)
    {
        return $query->where('brand_type', 'non-viar');
    }

    public function scopeOptional($query)
    {
        return $query->where('brand_type', 'optional');
    }
}
