<?php

namespace App\Events\Backend\Shift;

use Illuminate\Queue\SerializesModels;

/**
 * Class ShiftCreated.
 */
class ShiftCreated
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
