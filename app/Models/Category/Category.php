<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category\Traits\Relationship\CategoryRelationship;
use App\Models\Category\Traits\Attribute\CategoryAttribute;

class Category extends Model
{
    //
    use SoftDeletes,
        CategoryRelationship,
        CategoryAttribute;

    protected $fillable = [
        'name'
    ];

    protected $appends = [
        'product_count',
        'category_name'
    ];
}
