<?php

namespace App\Events\Backend\Category;

use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryDeletedPermanently.
 */
class CategoryDeletedPermanently
{
    use SerializesModels;

    /**
     * @var
     */
    public $doer;
    public $category;

    /**
     * @param $doer
     * @param $category
     */
    public function __construct($doer, $category)
    {
        $this->doer    = $doer;
        $this->category = $category;
    }
}
