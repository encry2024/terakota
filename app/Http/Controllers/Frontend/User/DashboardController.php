<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Discount\Discount;
use App\Models\Dining\Dining;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dinings = Dining::orderBy('name', 'asc')->get();

        return view('frontend.user.dashboard')->withDinings($dinings);
    }


}
