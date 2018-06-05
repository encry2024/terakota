<?php

namespace App\Models\Order\Traits\Attribute;

trait OrderProductAttribute
{
    public function getCustomerTypeAttribute()
    {
        switch ($this->order_type) {
            case 0:
                return "Dine-in";
                break;
            case 1:
                return "Take-out";
                break;
            case 2:
                return "Salary Deduct";
                break;
            case 3:
                return "Acknowledgement";
                break;
        }
    }
}
