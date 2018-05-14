<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Events\Backend\Product\ProductDeleted;
use App\Repositories\Backend\Product\ProductRepository;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\ManageProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use Auth;
use App\Models\Category\Category;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * ProductController constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ManageProductRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageProductRequest $request)
    {
        return view('backend.product.index')
            ->withProducts($this->productRepository->getProductPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageProductRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageProductRequest $request)
    {
        $categories = Category::all();

        return view('backend.product.create')->withCategories($categories);
    }

    /**
     * @param StoreProductRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productRepository->create($request->only(
            'code',
            'name',
            'price',
            'category'
        ));

        return redirect()->route('admin.product.index')->withFlashSuccess(__('alerts.backend.products.created', ['product' => $product->name]));
    }

    /**
     * @param ManageProductRequest $request
     * @param Product              $product
     *
     * @return mixed
     */
    public function show(ManageProductRequest $request, Product $product)
    {
        return view('backend.product.show')
            ->withProduct($product);
    }

    /**
     * @param ManageProductRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param Product                 $product
     *
     * @return mixed
     */
    public function edit(ManageProductRequest $request, Product $product)
    {
        $categories = Category::all();

        return view('backend.product.edit')->withProduct($product)->withCategories($categories);
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product              $product
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = $this->productRepository->update($product, $request->only(
            'code',
            'name',
            'price',
            'category'
        ));

        return redirect()->route('admin.product.index')->withFlashSuccess(__('alerts.backend.products.updated', ['product' => $product->name]));
    }

    /**
     * @param ManageProductRequest $request
     * @param Product              $product
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageProductRequest $request, Product $product)
    {
        $product_name = $product->name;
        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.product.show', $product->id)."'>".$product->name.'</a>';

        $product = $this->productRepository->deleteById($product->id);

        event(new ProductDeleted($auth_link, $asset_link));

        return redirect()->route('admin.product.deleted')->withFlashSuccess(__('alerts.backend.products.deleted', ['product' => $product_name]));
    }
}
