<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_discount',
        'category_id',
    ];

    // Casting untuk memastikan tipe data benar
    protected $casts = [
        'product_price' => 'decimal:2',
    ];

    /**
     * Relasi Many-to-One dengan Category.
     * Banyak produk milik satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi One-to-Many dengan ProductVariant.
     * Satu produk bisa memiliki banyak varian.
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Relasi One-to-Many dengan ProductImage.
     * Satu produk bisa memiliki banyak gambar.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Accessor untuk menghitung harga setelah diskon.
     * Ini lebih baik daripada menyimpannya di database.
     */
    public function getProductPriceAfterDiscountAttribute()
    {
        if ($this->product_discount > 0) {
            return $this->product_price - ($this->product_price * $this->product_discount / 100);
        }
        return $this->product_price;
    }



    // Product Highlights relationship
    public function highlights()
    {
        return $this->hasMany(ProductHighlight::class);
    }

    public function activeHighlights()
    {
        return $this->hasMany(ProductHighlight::class)
                    ->where(function ($q) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                    });
    }
}