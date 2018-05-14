<?php

namespace App\Events\Backend\Dining;

use Illuminate\Queue\SerializesModels;

/**
 * Class DiningCreated.
 */
class DiningCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $doer;
    public $dining;

    /**
     * @param $doer
     * @param $dining
     */
    public function __construct($doer, $dining)
    {
        $this->doer  = $doer;
        $this->dining = $dining;
    }
}
