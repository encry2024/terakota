<?php

namespace App\Events\Backend\Shift;

use Illuminate\Queue\SerializesModels;

/**
 * Class ShiftUpdated.
 */
class ShiftUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $doer;
    public $shift;

    /**
     * @param $doer
     * @param $shift
     */
    public function __construct($doer, $shift)
    {
        $this->doer  = $doer;
        $this->shift = $shift;
    }
}
