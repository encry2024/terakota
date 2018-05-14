<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Product\ProductRepository;
use App\Http\Requests\Backend\Product\ManageProductRequest;

/**
 * Class ProductStatusController.
 */
class ProductStatusController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageProductRequest $request)
    {
        return view('backend.product.deleted')
            ->withProducts($this->productRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageProductRequest $request
     * @param Product              $deletedProduct
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageProductRequest $request, Product $deletedProduct)
    {
        $product = $this->productRepository->forceDelete($deletedProduct);

        return redirect()->route('admin.product.deleted')->withFlashSuccess(__('alerts.backend.products.deleted_permanently', ['product' => $deletedProduct->name]));
    }

    /**
     * @param ManageProductRequest $request
     * @param Product              $deletedProduct
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageProductRequest $request, Product $deletedProduct)
    {
        $product = $this->productRepository->restore($deletedProduct);

        return redirect()->route('admin.product.index')->withFlashSuccess(__('alerts.backend.products.restored', ['product' => $product->name]));
    }
}
