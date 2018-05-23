<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order\Traits\Relationship\OrderRelationship;

class Order extends Model
{
    use SoftDeletes,
        OrderRelationship;

    //
    public $fillable = [
        'user_id',
        'dining_id',
        'status',
    ];
}
