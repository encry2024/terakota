<?php

namespace App\Events\Backend\Product;

use Illuminate\Queue\SerializesModels;

/**
 * Class ProductDeleted.
 */
class ProductDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $doer;
    public $product;

    /**
     * @param $doer
     * @param $product
     */
    public function __construct($doer, $product)
    {
        $this->doer    = $doer;
        $this->product = $product;
    }
}
