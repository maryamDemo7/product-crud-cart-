<?php

namespace App\Models;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_price', 'product_description'
    ];

    public function images() {
        return $this->hasMany(ProductImage::class);
    }
}
