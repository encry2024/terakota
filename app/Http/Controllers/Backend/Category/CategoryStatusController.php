<?php

namespace App\Http\Controllers\Backend\Category;

use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Http\Requests\Backend\Category\ManageCategoryRequest;

/**
 * Class CategoryStatusController.
 */
class CategoryStatusController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageCategoryRequest $request)
    {
        return view('backend.category.deleted')
            ->withCategories($this->categoryRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageCategoryRequest $request
     * @param Category              $deletedCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageCategoryRequest $request, Category $deletedCategory)
    {
        $category = $this->categoryRepository->forceDelete($deletedCategory);

        return redirect()->route('admin.category.deleted')->withFlashSuccess(__('alerts.backend.categories.deleted_permanently', ['category' => $deletedCategory->name]));
    }

    /**
     * @param ManageCategoryRequest $request
     * @param Category              $deletedCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageCategoryRequest $request, Category $deletedCategory)
    {
        $category = $this->categoryRepository->restore($deletedCategory);

        return redirect()->route('admin.category.index')->withFlashSuccess(__('alerts.backend.categories.restored', ['category' => $category->name]));
    }
}
