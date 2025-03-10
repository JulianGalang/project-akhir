<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        "user_id",
        "products_id",
        "quantity",
    ];


    // Relasi dengan model Product
// Cart.php
public function products()
{
    return $this->belongsTo(Product::class);
}
}
