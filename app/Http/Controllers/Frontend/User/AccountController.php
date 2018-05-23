<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.account');
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
