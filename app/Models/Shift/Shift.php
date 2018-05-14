<?php

namespace App\Models\Shift;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Shift\Traits\Relationship\ShiftRelationship;
use App\Models\Shift\Traits\Attribute\ShiftAttribute;

class Shift extends Model
{
    //
    use SoftDeletes,
        ShiftRelationship,
        ShiftAttribute;

    protected $fillable = [
        'name',
        'time_start',
        'time_end',
    ];

    protected $appends = [
        'employee'
    ];
}
