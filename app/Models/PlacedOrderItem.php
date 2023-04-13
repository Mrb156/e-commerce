<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacedOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "placed_order_id",
        "product_id",
        "quantity",
        "price",
    ];
}
