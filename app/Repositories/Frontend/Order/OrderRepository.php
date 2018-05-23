<?php

namespace App\Repositories\Frontend\Order;

use App\Models\Order\Order;
use App\Models\Dining\Dining;
use App\Models\Order\OrderProduct;
use App\Models\Product\Product;
use App\Models\Discount\Discount;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPendingOrders(array $data)
    {
        $order = Order::where('dining_id', $data['dining_id'])
            ->whereStatus('PENDING')
            ->orderBy('created_at', 'desc')
            ->first();

        $order_products = OrderProduct::with(['product', 'discount', 'order'])->where('order_id', $order->id)->get();

        return $order_products;
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
     * @return Order
     * @throws \Exception
     * @throws \Throwable
     */
    public function createOrder(array $data) : OrderProduct
    {
        return DB::transaction(function () use ($data) {
            $dining = Dining::find($data['dining_id']);

            $order = Order::where('dining_id', $dining->id)
                ->whereStatus('PENDING')
                ->orderBy('created_at', 'desc')
                ->first();

            if (count($order) == 0) {
                $new_order = parent::create([
                    'user_id' => Auth::user()->id,
                    'dining_id' => $dining->id
                ]);

                if ($new_order) {
                    $product = Product::find($data['product_id']);
                    $discount = Discount::find($data['discount_id']);

                    if ($discount) {
                        $order_product = OrderProduct::create([
                            'order_id' => $order->id,
                            'product_id' => $data['product_id'],
                            'quantity' => $data['quantity'],
                            'amount' => $product->price - ($product->price * ($discount->discount / 100)),
                            'discount_id' => $data['discount_id'] == 0 ? 0 : $data['discount_id'],
                            'senior_id' => $data['senior_id'],
                            'order_type' => $data['order_type']
                        ]);

                        if ($order_product) {
                            return $order_product;
                        }
                    } else {
                        $order_product = OrderProduct::create([
                            'order_id' => $order->id,
                            'product_id' => $data['product_id'],
                            'quantity' => $data['quantity'],
                            'amount' => $product->price,
                            'discount_id' => $data['discount_id'] == 0 ? 0 : $data['discount_id'],
                            'senior_id' => $data['senior_id'],
                            'order_type' => $data['order_type']
                        ]);

                        if ($order_product) {
                            return $order_product;
                        }
                    }
                }

                throw new GeneralException(__('exceptions.backend.categories.create_error'));
            } else {
                $product = Product::find($data['product_id']);
                $discount = Discount::find($data['discount_id']);

                if ($discount) {
                    $order_product = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $data['product_id'],
                        'quantity' => $data['quantity'],
                        'amount' => $product->price - ($product->price * ($discount->discount / 100)),
                        'discount_id' => $data['discount_id'] == 0 ? 0 : $data['discount_id'],
                        'senior_id' => $data['senior_id'],
                        'order_type' => $data['order_type']
                    ]);

                    if ($order_product) {
                        return $order_product;
                    }
                } else {
                    $order_product = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $data['product_id'],
                        'quantity' => $data['quantity'],
                        'amount' => $product->price,
                        'discount_id' => $data['discount_id'] == 0 ? 0 : $data['discount_id'],
                        'senior_id' => $data['senior_id'],
                        'order_type' => $data['order_type']
                    ]);

                    if ($order_product) {
                        return $order_product;
                    }
                }

                throw new GeneralException(__('exceptions.backend.categories.create_error'));
            }
        });
    }

    public function removeProducts(array $data)
    {
        return DB::transaction(function () use ($data) {
            $order_product_ids = $data['order_product_array'];

            foreach ($order_product_ids as $order_product_id) {
                $order_product = OrderProduct::find($order_product_id);

                if ($order_product->update([
                    'status' => 'CANCELLED'
                ]))

                {
                    $order_product->delete();
                }
            }
        });
    }
}
