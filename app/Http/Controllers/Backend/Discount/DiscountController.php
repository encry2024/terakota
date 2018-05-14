<?php

namespace App\Http\Controllers\Backend\Discount;

use App\Models\Discount\Discount;
use App\Http\Controllers\Controller;
use App\Events\Backend\Discount\DiscountDeleted;
use App\Repositories\Backend\Discount\DiscountRepository;
use App\Http\Requests\Backend\Discount\StoreDiscountRequest;
use App\Http\Requests\Backend\Discount\ManageDiscountRequest;
use App\Http\Requests\Backend\Discount\UpdateDiscountRequest;
use Auth;
use App\Models\Auth\User;

/**
 * Class DiscountController.
 */
class DiscountController extends Controller
{
    /**
     * @var DiscountRepository
     */
    protected $discountRepository;

    /**
     * DiscountController constructor.
     *
     * @param DiscountRepository $discountRepository
     */
    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * @param ManageDiscountRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageDiscountRequest $request)
    {
        return view('backend.discount.index')
            ->withDiscounts($this->discountRepository->getDiscountPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageDiscountRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageDiscountRequest $request)
    {
        return view('backend.discount.create');
    }

    /**
     * @param StoreDiscountRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreDiscountRequest $request)
    {
        $discount = $this->discountRepository->create($request->only(
            'name',
            'discount'
        ));

        return redirect()->route('admin.discount.index')->withFlashSuccess(__('alerts.backend.discounts.created', ['discount' => $discount->name]));
    }

    /**
     * @param ManageDiscountRequest $request
     * @param Discount              $discount
     *
     * @return mixed
     */
    public function show(ManageDiscountRequest $request, Discount $discount)
    {
        return view('backend.discount.show')
            ->withDiscount($discount);
    }

    /**
     * @param ManageDiscountRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param Discount                 $discount
     *
     * @return mixed
     */
    public function edit(ManageDiscountRequest $request, Discount $discount)
    {
        return view('backend.discount.edit')->withDiscount($discount);
    }

    /**
     * @param UpdateDiscountRequest $request
     * @param Discount              $discount
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount = $this->discountRepository->update($discount, $request->only(
            'name',
            'discount'
        ));

        return redirect()->route('admin.discount.index')->withFlashSuccess(__('alerts.backend.discounts.updated', ['discount' => $discount->name]));
    }

    /**
     * @param ManageDiscountRequest $request
     * @param Discount              $discount
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageDiscountRequest $request, Discount $discount)
    {
        $discount_name = $discount->name;
        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.discount.show', $discount->id)."'>".$discount->name.'</a>';

        $discount = $this->discountRepository->deleteById($discount->id);

        event(new DiscountDeleted($auth_link, $asset_link));

        return redirect()->route('admin.discount.deleted')->withFlashSuccess(__('alerts.backend.discounts.deleted', ['discount' => $discount_name]));
    }
}
