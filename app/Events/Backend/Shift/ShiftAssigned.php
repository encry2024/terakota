<?php

namespace App\Events\Backend\Shift;

use Illuminate\Queue\SerializesModels;

/**
 * Class ShiftAssigned.
 */
class ShiftAssigned
{
    use SerializesModels;

    /**
     * @var
     */
    public $doer;
    public $employee;
    public $shift;

    /**
     * @param $doer
     * @param $shift
     */
    public function __construct($doer, $employee, $shift)
    {
        $this->doer  = $doer;
        $this->employee = $employee;
        $this->shift = $shift;
    }
}
