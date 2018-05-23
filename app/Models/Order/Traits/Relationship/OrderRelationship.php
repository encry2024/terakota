<?php

namespace App\Models\Order\Traits\Relationship;

use App\Models\Dining\Dining;
use App\Models\Auth\User;
use App\Models\Order\OrderProduct;

trait OrderRelationship
{
    //
    public function dining()
    {
        return $this->belongsTo(Dining::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
