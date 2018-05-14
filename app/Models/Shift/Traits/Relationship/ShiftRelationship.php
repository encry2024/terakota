<?php

namespace App\Models\Shift\Traits\Relationship;

use App\Models\Auth\User;

trait ShiftRelationship
{

    public function user()
    {
        return $this->hasOne(User::class);
    }

}