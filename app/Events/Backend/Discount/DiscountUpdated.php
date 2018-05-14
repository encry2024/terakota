<?php

namespace App\Events\Backend\Discount;

use Illuminate\Queue\SerializesModels;

/**
 * Class DiscountUpdated.
 */
class DiscountUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $doer;
    public $discount;

    /**
     * @param $doer
     * @param $discount
     */
    public function __construct($doer, $discount)
    {
        $this->doer  = $doer;
        $this->discount = $discount;
    }
}
