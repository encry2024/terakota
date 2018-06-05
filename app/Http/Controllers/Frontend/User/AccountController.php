<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Backend\Report\ReportRepository;
use App\Http\Requests\Backend\Sales\ViewSalesRequest;
use App\Models\Shift\Shift;
use Auth;

/**
 * Class AccountController.
 */
class AccountController extends Controller
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
        $user_id        = Auth::user()->id;

        $query = $this->reportRepository->getUserBasedSalesReport(
            null,
            $date_start,
            $date_end,
            $shift,
            $start_time,
            $end_time,
            $order_type,
            $sales_status,
            $user_id
        );

        // dd($query);

        return view('frontend.user.account')
            ->withSales($query)
            ->withShifts($shifts);
    }

    public function verifyAdmin($password)
    {
        $count  = 0;
    	$admins =  User::with(['roles' => function($q) {
                $q->whereIn('name', ['administrator']);
            }])
            ->whereHas('roles', function($q) {
                $q->whereIn('name', ['administrator']);
            })->get();

		foreach($admins as $admin)
		{
			if(Hash::check($password, $admin->password))
			{
				$count++;
			}
		}

		return $count;
    }
}
