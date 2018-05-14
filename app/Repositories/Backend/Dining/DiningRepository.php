<?php

namespace App\Repositories\Backend\Dining;

use App\Models\Dining\Dining;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Dining\DiningCreated;
use App\Events\Backend\Dining\DiningUpdated;
use App\Events\Backend\Dining\DiningRestored;
use App\Events\Backend\Dining\DiningDeletedPermanently;

/**
 * Class DiningRepository.
 */
class DiningRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Dining::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getDiningPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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
     * @return Dining
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Dining
    {
        return DB::transaction(function () use ($data) {
            $dining = parent::create([
                'name' => $data['name'],
                'price' => str_replace(",", "", $data['price']),
                'description' => $data['description']
            ]);

            if ($dining) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name."</a>";
                $asset_link = "<a href='".route('admin.dining.show', $dining->id)."'>".$dining->name."</a>";

                event(new DiningCreated($auth_link, $asset_link));

                return $dining;
            }

            throw new GeneralException(__('exceptions.backend.dinings.create_error'));
        });
    }

    /**
     * @param Dining  $dining
     * @param array $data
     *
     * @return Dining
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Dining $dining, array $data) : Dining
    {
        return DB::transaction(function () use ($dining, $data) {
            if ($dining->update([
                'name' => $data['name'],
                'price' => str_replace(",", "", $data['price']),
                'description' => $data['description']
            ])) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.dining.show', $dining->id)."'>".$dining->name.'</a>';

                event(new DiningUpdated($auth_link, $asset_link));

                return $dining;
            }

            throw new GeneralException(__('exceptions.backend.dinings.update_error'));
        });
    }

    /**
     * @param Dining $dining
     *
     * @return Dining
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Dining $dining) : Dining
    {
        return DB::transaction(function () use ($dining) {
            if ($dining->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = $dining->name;

                event(new DiningDeletedPermanently($auth_link, $asset_link));

                return $dining;
            }

            throw new GeneralException(__('exceptions.backend.dinings.delete_error'));
        });
    }

    /**
     * @param Dining $dining
     *
     * @return Dining
     * @throws GeneralException
     */
    public function restore(Dining $dining) : Dining
    {
        if ($dining->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.dining.show', $dining->id)."'>".$dining->name.'</a>';

            event(new DiningRestored($auth_link, $asset_link));

            return $dining;
        }

        throw new GeneralException(__('exceptions.backend.dinings.restore_error'));
    }
}
