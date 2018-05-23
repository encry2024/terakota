<?php

namespace App\Models\Order\Traits\Relationship;

use App\Models\Product\Product;
use App\Models\Order\Order;
use App\Models\Discount\Discount;

trait OrderProductRelationship
{
    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
