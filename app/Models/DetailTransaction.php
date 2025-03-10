<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $fillable = [
        'code',
        'product_id',
        'quantity',
        'total_price',
    ];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'code', 'code');
    }

    public function products()
    {
        return $this->belongsTo(Product::class ,'product_id','id');
    }
}
