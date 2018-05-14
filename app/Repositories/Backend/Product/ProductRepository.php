<?php

namespace App\Repositories\Backend\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Product\ProductCreated;
use App\Events\Backend\Product\ProductUpdated;
use App\Events\Backend\Product\ProductRestored;
use App\Events\Backend\Product\ProductDeletedPermanently;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getProductPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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
     * @return Product
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Product
    {
        return DB::transaction(function () use ($data) {
            $product = parent::create([
                'name'  => $data['name'],
                'code'  => $data['code'],
                'price' => str_replace(",", "", $data['price']),
                'category_id' => $data['category']
            ]);

            if ($product) {

                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.product.show', $product->id)."'>".$product->name.'</a>';

                event(new ProductCreated($auth_link, $asset_link));

                return $product;
            }

            throw new GeneralException(__('exceptions.backend.products.create_error'));
        });
    }

    /**
     * @param Product  $product
     * @param array $data
     *
     * @return Product
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Product $product, array $data) : Product
    {
        return DB::transaction(function () use ($product, $data) {
            if ($product->update([
                'name'  => $data['name'],
                'code'  => $data['code'],
                'price' => str_replace(",", "", $data['price']),
                'category_id' => $data['category']
            ])) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.product.show', $product->id)."'>".$product->name.'</a>';

                event(new ProductUpdated($auth_link, $asset_link));

                return $product;
            }

            throw new GeneralException(__('exceptions.backend.products.update_error'));
        });
    }

    /**
     * @param Product $product
     *
     * @return Product
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Product $product) : Product
    {
        return DB::transaction(function () use ($product) {
            if ($product->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = $product->name;

                event(new ProductDeletedPermanently($auth_link, $asset_link));

                return $product;
            }

            throw new GeneralException(__('exceptions.backend.products.delete_error'));
        });
    }

    /**
     * @param Product $product
     *
     * @return Product
     * @throws GeneralException
     */
    public function restore(Product $product) : Product
    {
        if ($product->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.product.show', $product->id)."'>".$product->name.'</a>';

            event(new ProductRestored($auth_link, $asset_link));

            return $product;
        }

        throw new GeneralException(__('exceptions.backend.products.restore_error'));
    }
}
