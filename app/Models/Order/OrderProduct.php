<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order\Traits\Relationship\OrderProductRelationship;

class OrderProduct extends Model
{
    //
    use SoftDeletes,
        OrderProductRelationship;

    protected $fillable = [
        'product_id',
        'order_id',
        'discount_id',
        'senior_id',
        'quantity',
        'amount',
        'vat',
        'status',
        'order_type'
    ];
}
