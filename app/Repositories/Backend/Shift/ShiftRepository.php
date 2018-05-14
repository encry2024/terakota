<?php

namespace App\Repositories\Backend\Shift;

use App\Models\Shift\Shift;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Shift\ShiftCreated;
use App\Events\Backend\Shift\ShiftUpdated;
use App\Events\Backend\Shift\ShiftRestored;
use App\Events\Backend\Shift\ShiftDeletedPermanently;

/**
 * Class ShiftRepository.
 */
class ShiftRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Shift::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getShiftPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->withCount(['user'])
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
     * @return Shift
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Shift
    {
        return DB::transaction(function () use ($data) {
            $shift = parent::create([
                'name' => date('h:i A', strtotime($data['time_start'])).' - '.date('h:i A', strtotime($data['time_end'])),
                'time_start' => $data['time_start'],
                'time_end' => $data['time_end']
            ]);

            if ($shift) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name."</a>";
                $asset_link = "<a href='".route('admin.shift.show', $shift->id)."'>".$shift->name."</a>";

                event(new ShiftCreated($auth_link, $asset_link));

                return $shift;
            }

            throw new GeneralException(__('exceptions.backend.shifts.create_error'));
        });
    }

    /**
     * @param Shift  $shift
     * @param array $data
     *
     * @return Shift
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Shift $shift, array $data) : Shift
    {
        return DB::transaction(function () use ($shift, $data) {
            if ($shift->update([
                'name' => date('h:i A', strtotime($data['time_start'])).' - '.date('h:i A', strtotime($data['time_end'])),
                'time_start' => $data['time_start'],
                'time_end' => $data['time_end']
            ])) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.shift.show', $shift->id)."'>".$shift->name.'</a>';

                event(new ShiftUpdated($auth_link, $asset_link));

                return $shift;
            }

            throw new GeneralException(__('exceptions.backend.shifts.update_error'));
        });
    }

    /**
     * @param Shift $shift
     *
     * @return Shift
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Shift $shift) : Shift
    {
        return DB::transaction(function () use ($shift) {
            if ($shift->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = $shift->name;

                event(new ShiftDeletedPermanently($auth_link, $asset_link));

                return $shift;
            }

            throw new GeneralException(__('exceptions.backend.shifts.delete_error'));
        });
    }

    /**
     * @param Shift $shift
     *
     * @return Shift
     * @throws GeneralException
     */
    public function restore(Shift $shift) : Shift
    {
        if ($shift->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.shift.show', $shift->id)."'>".$shift->name.'</a>';

            event(new ShiftRestored($auth_link, $asset_link));

            return $shift;
        }

        throw new GeneralException(__('exceptions.backend.shifts.restore_error'));
    }
}
