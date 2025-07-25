<?php
// app/Models/TimeDeal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeDeal extends Model
{
    protected $fillable = ['product_id', 'start_time', 'end_time', 'discount_price'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isActive()
    {
        return now()->between($this->start_time, $this->end_time);
    }
}
