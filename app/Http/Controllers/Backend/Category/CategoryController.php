<?php

namespace App\Http\Controllers\Backend\Category;

use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Events\Backend\Category\CategoryDeleted;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\ManageCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use Auth;

/**
 * Class CategoryController.
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param ManageCategoryRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageCategoryRequest $request)
    {
        return view('backend.category.index')
            ->withCategories($this->categoryRepository->getCategoryPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageCategoryRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageCategoryRequest $request)
    {
        return view('backend.category.create');
    }

    /**
     * @param StoreCategoryRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->only(
            'name'
        ));

        return redirect()->route('admin.category.index')->withFlashSuccess(__('alerts.backend.categories.created', ['category' => $category->name]));
    }

    /**
     * @param ManageCategoryRequest $request
     * @param Category              $category
     *
     * @return mixed
     */
    public function show(ManageCategoryRequest $request, Category $category)
    {
        return view('backend.category.show')
            ->withCategory($category);
    }

    /**
     * @param ManageCategoryRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param Category                 $category
     *
     * @return mixed
     */
    public function edit(ManageCategoryRequest $request, Category $category)
    {
        return view('backend.category.edit')->withCategory($category);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category              $category
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category = $this->categoryRepository->update($category, $request->only(
            'name'
        ));

        return redirect()->route('admin.category.index')->withFlashSuccess(__('alerts.backend.categories.updated', ['category' => $category->name]));
    }

    /**
     * @param ManageCategoryRequest $request
     * @param Category              $category
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageCategoryRequest $request, Category $category)
    {
        $category_name = $category->name;
        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.category.show', $category->id)."'>".$category->name.'</a>';

        $category = $this->categoryRepository->deleteById($category->id);

        event(new CategoryDeleted($auth_link, $asset_link));

        return redirect()->route('admin.category.deleted')->withFlashSuccess(__('alerts.backend.categories.deleted', ['category' => $category_name]));
    }
}
