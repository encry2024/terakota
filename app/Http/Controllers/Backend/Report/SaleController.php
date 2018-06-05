<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Order\OrderProduct;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Report\ReportRepository;
use App\Http\Requests\Backend\Sales\ViewSalesRequest;
use App\Models\Shift\Shift;

class SaleController extends Controller
{
    protected $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ViewSalesRequest $request)
    {
        $shifts         = Shift::all();
        $date_start     = $request->get('date_start') == null ? null : $request->get('date_start');
        $date_end       = $request->get('date_end') == null ? null : $request->get('date_end');
        $shift          = $request->get('shift') ? $request->shift : null;
        $start_time     = $request->get('start_time') == null ? '00:00:00' : $request->get('start_time');
        $end_time       = $request->get('end_time') == null ? '23:59:59' : $request->get('end_time');
        $order_type     = $request->get('order_type') ? $request->get('order_type') : null;
        $sales_status   = $request->get('sales_status') ? $request->get('sales_status') : 'all';

        $query = $this->reportRepository->getSalesReport(
            null,
            $date_start,
            $date_end,
            $shift,
            $start_time,
            $end_time,
            $order_type,
            $sales_status
        );

        // dd($query);

        return view('backend.report.sales.index')
            ->withSales($query)
            ->withShifts($shifts);
    }

}
