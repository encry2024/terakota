<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product\Traits\Relationship\ProductRelationship;
use App\Models\Product\Traits\Attribute\ProductAttribute;

class Product extends Model
{
    //
    use SoftDeletes,
        ProductRelationship,
        ProductAttribute;

    protected $fillable = [
        'code',
        'name',
        'price',
        'category_id'
    ];

    protected $appends = [
        'formatted_price',
        'category_name'
    ];
}
