<?php

namespace App\Repositories\Backend\Report;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Order\OrderProduct;
use App\Models\Shift\Shift;

/**
 * Class ReportRepository.
 */
class ReportRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return OrderProduct::class;
    }

    public function initialDate($start_date, $start_time)
    {
        return date('Y-m-d H:i:s', strtotime($start_date.' '.$start_time));
    }

    public function finalDate($end_date, $end_time)
    {
        return date('Y-m-d H:i:s', strtotime($end_date.' '.$end_time));
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed4
     */
    public function getSalesReport($page = 50, $startingDate = null, $endingDate = null, $shift = null, $startingTime, $endingTime, $orderType = 0, $status = null)
    {
        $start_date = date('Y-m-d', strtotime($startingDate));
        $start_time = date('H:i:s', strtotime($startingTime));
        $end_date   = date('Y-m-d', strtotime($endingDate));
        $end_time   = date('H:i:s', strtotime($endingTime));

        $query = new OrderProduct;

        if ($orderType != null) {
            $query = $query->where('order_type', $orderType);
        }

        if ($shift != null) {
            $getShift = Shift::find($shift);

            $start_time = date('H:i:s', strtotime($getShift->time_start));
            $end_time   = date('H:i:s', strtotime($getShift->time_end));

            $query = $query->whereBetween('created_at', [$this->initialDate($start_date, $start_time), $this->finalDate($end_date, $end_time)]);
        }

        if ($status != 'all') {
            $query = $query->where('status', $status);
        }

        return $query->paginate($page);
    }

    public function getUserBasedSalesReport($page = 50, $startingDate = null, $endingDate = null, $shift = null, $startingTime, $endingTime, $orderType = 0, $status = null, $user_id)
    {
        $start_date = date('Y-m-d', strtotime($startingDate));
        $start_time = date('H:i:s', strtotime($startingTime));
        $end_date   = date('Y-m-d', strtotime($endingDate));
        $end_time   = date('H:i:s', strtotime($endingTime));

        $query = OrderProduct::with(['order' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }]);

        if ($orderType != null) {
            $query = $query->where('order_type', $orderType);
        }

        if ($shift != null) {
            $getShift = Shift::find($shift);

            $start_time = date('H:i:s', strtotime($getShift->time_start));
            $end_time   = date('H:i:s', strtotime($getShift->time_end));

            $query = $query->whereBetween('created_at', [$this->initialDate($start_date, $start_time), $this->finalDate($end_date, $end_time)]);
        }

        if ($status != 'all') {
            $query = $query->where('status', $status);
        }

        return $query->paginate($page);
    }
}
