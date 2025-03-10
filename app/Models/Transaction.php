<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\DetailTransaction;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = [
        'code', 'user_id', 'total_item', 'total', 'status', 'resi', 'description'
    ];

    public function details()
    {
        return $this->hasMany(DetailTransaction::class, 'code', 'code');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail()
    {
        return $this->belongsTo(DetailTransaction::class);
    }

}
