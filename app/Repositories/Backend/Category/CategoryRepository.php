<?php

namespace App\Repositories\Backend\Category;

use App\Models\Category\Category;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Category\CategoryCreated;
use App\Events\Backend\Category\CategoryUpdated;
use App\Events\Backend\Category\CategoryRestored;
use App\Events\Backend\Category\CategoryDeletedPermanently;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getCategoryPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->withCount(['products'])
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
     * @return Category
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Category
    {
        return DB::transaction(function () use ($data) {
            $category = parent::create([
                'name' => $data['name']
            ]);

            if ($category) {

                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.category.show', $category->id)."'>".$category->name.'</a>';

                event(new CategoryCreated($auth_link, $asset_link));

                return $category;
            }

            throw new GeneralException(__('exceptions.backend.categories.create_error'));
        });
    }

    /**
     * @param Category  $category
     * @param array $data
     *
     * @return Category
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Category $category, array $data) : Category
    {
        return DB::transaction(function () use ($category, $data) {
            if ($category->update([
                'name' => $data['name']
            ])) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.category.show', $category->id)."'>".$category->name.'</a>';

                event(new CategoryUpdated($auth_link, $asset_link));

                return $category;
            }

            throw new GeneralException(__('exceptions.backend.categories.update_error'));
        });
    }

    /**
     * @param Category $category
     *
     * @return Category
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Category $category) : Category
    {
        return DB::transaction(function () use ($category) {
            if ($category->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = $category->name;

                event(new CategoryDeletedPermanently($auth_link, $asset_link));

                return $category;
            }

            throw new GeneralException(__('exceptions.backend.categories.delete_error'));
        });
    }

    /**
     * @param Category $category
     *
     * @return Category
     * @throws GeneralException
     */
    public function restore(Category $category) : Category
    {
        if ($category->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.category.show', $category->id)."'>".$category->name.'</a>';

            event(new CategoryRestored($auth_link, $asset_link));

            return $category;
        }

        throw new GeneralException(__('exceptions.backend.categories.restore_error'));
    }
}
