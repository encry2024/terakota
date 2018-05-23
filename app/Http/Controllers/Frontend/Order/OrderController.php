<?php

namespace App\Http\Controllers\Frontend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Discount\Discount;
use App\Models\Dining\Dining;
use App\Repositories\Frontend\Order\OrderRepository;
use App\Http\Requests\Frontend\Order\StoreOrderRequest;
use App\Http\Requests\Frontend\Order\RemoveOrderRequest;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dining $dining)
    {
        $products   = Product::all();
        $categories = Category::all();
        $discounts  = Discount::all();

        return view('frontend.user.order.create')
            ->withProducts($products)
            ->withCategories($categories)
            ->withDiscounts($discounts)
            ->withDining($dining);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(StoreOrderRequest $request)
    {
        $order_product = $this->orderRepository->createOrder($request->only(
            'user_id',
            'dining_id',
            'product_id',
            'quantity',
            'discount_id',
            'senior_id',
            'order_type'
        ));

        return json_encode(['order_product' => $order_product, 'product' => $order_product->product, 'discount' => $order_product->discount, 'order' => $order_product->order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPendings(Request $request)
    {
        $pending_orders = $this->orderRepository->getPendingOrders($request->only('dining_id'));

        return json_encode($pending_orders);
    }

    public function remove(RemoveOrderRequest $request)
    {
        $order_product = $this->orderRepository->removeProducts($request->only(
            'order_product_array'
        ));

        return json_encode($order_product);
    }
}
