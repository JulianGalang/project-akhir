<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = [
        'name',
        'categories_id',
        'group',
        'size',
        'stock',
        'price',
        'picture',
        'description',
    ];
    use HasFactory;

    // Model Product
public function categories()
{
    return $this->belongsTo(Categories::class);
}
     // Relasi dengan model Cart
// Product.php
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function details()
    {
        return $this->hasMany(DetailTransaction::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
