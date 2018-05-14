<?php

namespace App\Repositories\Backend\Discount;

use App\Models\Discount\Discount;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Discount\DiscountCreated;
use App\Events\Backend\Discount\DiscountUpdated;
use App\Events\Backend\Discount\DiscountRestored;
use App\Events\Backend\Discount\DiscountDeletedPermanently;

/**
 * Class DiscountRepository.
 */
class DiscountRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Discount::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getDiscountPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Discount
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Discount
    {
        return DB::transaction(function () use ($data) {
            $discount = parent::create([
                'name' => $data['name'],
                'discount' => str_replace(",", "", $data['discount'])
            ]);

            if ($discount) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name."</a>";
                $asset_link = "<a href='".route('admin.discount.show', $discount->id)."'>".$discount->name."</a>";

                event(new DiscountCreated($auth_link, $asset_link));

                return $discount;
            }

            throw new GeneralException(__('exceptions.backend.discounts.create_error'));
        });
    }

    /**
     * @param Discount  $discount
     * @param array $data
     *
     * @return Discount
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Discount $discount, array $data) : Discount
    {
        return DB::transaction(function () use ($discount, $data) {
            if ($discount->update([
                'name' => $data['name'],
                'discount' => str_replace(",", "", $data['discount'])
            ])) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.discount.show', $discount->id)."'>".$discount->name.'</a>';

                event(new DiscountUpdated($auth_link, $asset_link));

                return $discount;
            }

            throw new GeneralException(__('exceptions.backend.discounts.update_error'));
        });
    }

    /**
     * @param Discount $discount
     *
     * @return Discount
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Discount $discount) : Discount
    {
        return DB::transaction(function () use ($discount) {
            if ($discount->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = $discount->name;

                event(new DiscountDeletedPermanently($auth_link, $asset_link));

                return $discount;
            }

            throw new GeneralException(__('exceptions.backend.discounts.delete_error'));
        });
    }

    /**
     * @param Discount $discount
     *
     * @return Discount
     * @throws GeneralException
     */
    public function restore(Discount $discount) : Discount
    {
        if ($discount->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.discount.show', $discount->id)."'>".$discount->name.'</a>';

            event(new DiscountRestored($auth_link, $asset_link));

            return $discount;
        }

        throw new GeneralException(__('exceptions.backend.discounts.restore_error'));
    }
}
