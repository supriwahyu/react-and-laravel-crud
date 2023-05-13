<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
