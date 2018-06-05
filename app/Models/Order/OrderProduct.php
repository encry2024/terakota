<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order\Traits\Relationship\OrderProductRelationship;
use App\Models\Order\Traits\Attribute\OrderProductAttribute;

class OrderProduct extends Model
{
    //
    use SoftDeletes,
        OrderProductAttribute,
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

    protected $appends = [
        'customer_type'
    ];
}
