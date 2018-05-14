<?php

namespace App\Http\Controllers\Backend\Discount;

use App\Models\Discount\Discount;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Discount\DiscountRepository;
use App\Http\Requests\Backend\Discount\ManageDiscountRequest;

/**
 * Class DiscountStatusController.
 */
class DiscountStatusController extends Controller
{
    /**
     * @var DiscountRepository
     */
    protected $discountRepository;

    /**
     * @param DiscountRepository $discountRepository
     */
    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * @param ManageDiscountRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageDiscountRequest $request)
    {
        return view('backend.discount.deleted')
            ->withDiscounts($this->discountRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageDiscountRequest $request
     * @param Discount              $deletedDiscount
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageDiscountRequest $request, Discount $deletedDiscount)
    {
        $discount = $this->discountRepository->forceDelete($deletedDiscount);

        return redirect()->route('admin.discount.deleted')->withFlashSuccess(__('alerts.backend.discounts.deleted_permanently', ['discount' => $deletedDiscount->name]));
    }

    /**
     * @param ManageDiscountRequest $request
     * @param Discount              $deletedDiscount
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageDiscountRequest $request, Discount $deletedDiscount)
    {
        $discount = $this->discountRepository->restore($deletedDiscount);

        return redirect()->route('admin.discount.index')->withFlashSuccess(__('alerts.backend.discounts.restored', ['discount' => $discount->name]));
    }
}
