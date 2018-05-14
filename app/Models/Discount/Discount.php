<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Discount\Traits\Attribute\DiscountAttribute;

class Discount extends Model
{
    //
    use SoftDeletes,
        DiscountAttribute;

    protected $fillable = [
        'name',
        'discount'
    ];

    protected $appends = [
        'formatted_price'
    ];
}
