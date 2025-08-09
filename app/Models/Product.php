<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'brand_id', 'subcategory_id', 'price',
        'compare_price',  // Add this line
        'main_image', 'description', 'is_featured', 'is_trending'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function current_stock()
    {
        return $this->stocks()->sum('quantity');
    }
}
