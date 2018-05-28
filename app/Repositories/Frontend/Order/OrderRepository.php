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
        $order = Order::where('id', $data['order_id'])
            ->whereStatus('PENDING')
            ->orderBy('created_at', 'desc')
            ->first();

        $order_products = OrderProduct::with(['product', 'discount', 'order'])->where('order_id', $order->id)->get();

        return ['ordered_products' => $order_products, 'order' => $order];
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
    public function createOrder(Order $order, array $data) : OrderProduct
    {
        return DB::transaction(function () use ($order, $data) {
            $discount   = Discount::find($data['discount_id']);
            $order      = Order::find($order->id);

            if ($discount) {
                $product    = Product::find($data['product_id']);

                if ($product) {
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
                    return false;
                }
            } else {
                $product    = Product::find($data['product_id']);

                if ($product) {
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
                } else {
                    return false;
                }
            }

            throw new GeneralException('Something went wrong when saving an order. Contact the developer for inspection.');
        });
    }

    /**
     * @param array $data
     *
     * @return Order
     * @throws \Exception
     * @throws \Throwable
     */
    public function storeOrder(array $data) : Order
    {
        return DB::transaction(function () use ($data) {
            $dining_id = $data['dining_id'];

            $find_order = Order::where('dining_id', $dining_id)
                ->whereStatus('PENDING')
                ->first();

            if (! $find_order) {
                $order = parent::create([
                    'user_id'   => Auth::user()->id,
                    'dining_id' => $data['dining_id']
                ]);

                if ($order) {
                    return $order;
                }
            } else {
                return $find_order;
            }

            throw new GeneralException('Something went wrong when creating the order. Contact the developer for inspection.');
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

    public function cancel(Order $order) : Order
    {
        return DB::transaction(function () use ($order) {
            $i = 0;
            $order = Order::where('id', $order->id)
                ->where('status', 'PENDING')
                ->first();

            if ($order) {
                $order_products = OrderProduct::where('order_id', $order->id)->get();

                if (count($order_products) >= $i) {
                    foreach ($order_products as $order_product) {
                        if ($order_product->update(['status' => 'CANCELLED'])) {
                            $i++;
                        }
                    }
                }

                if (count($order_products) == $i) {
                    $validate = $order->update(['status' => 'CANCELLED']);

                    if ($validate) {
                        return $order;
                    }
                }
            }
        });
    }
}
