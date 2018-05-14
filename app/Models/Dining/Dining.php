<?php

namespace App\Models\Dining;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Dining\Traits\Attribute\DiningAttribute;

class Dining extends Model
{
    //
    use SoftDeletes,
        DiningAttribute;

    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    protected $appends = [
        'formatted_price'
    ];
}
