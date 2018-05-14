<?php

namespace App\Http\Controllers\Backend\Shift;

use App\Models\Shift\Shift;
use App\Http\Controllers\Controller;
use App\Events\Backend\Shift\ShiftDeleted;
use App\Repositories\Backend\Shift\ShiftRepository;
use App\Http\Requests\Backend\Shift\StoreShiftRequest;
use App\Http\Requests\Backend\Shift\ManageShiftRequest;
use App\Http\Requests\Backend\Shift\UpdateShiftRequest;
use Auth;
use App\Models\Auth\User;

/**
 * Class ShiftController.
 */
class ShiftController extends Controller
{
    /**
     * @var ShiftRepository
     */
    protected $shiftRepository;

    /**
     * ShiftController constructor.
     *
     * @param ShiftRepository $shiftRepository
     */
    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepository = $shiftRepository;
    }

    /**
     * @param ManageShiftRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageShiftRequest $request)
    {
        return view('backend.shift.index')
            ->withShifts($this->shiftRepository->getShiftPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageShiftRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageShiftRequest $request)
    {
        return view('backend.shift.create');
    }

    /**
     * @param StoreShiftRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreShiftRequest $request)
    {
        $shift = $this->shiftRepository->create($request->only(
            'name',
            'time_start',
            'time_end'
        ));

        return redirect()->route('admin.shift.index')->withFlashSuccess(__('alerts.backend.shifts.created', ['shift' => $shift->name]));
    }

    /**
     * @param ManageShiftRequest $request
     * @param Shift              $shift
     *
     * @return mixed
     */
    public function show(ManageShiftRequest $request, Shift $shift)
    {
        return view('backend.shift.show')
            ->withShift($shift);
    }

    /**
     * @param ManageShiftRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param Shift                 $shift
     *
     * @return mixed
     */
    public function edit(ManageShiftRequest $request, Shift $shift)
    {
        return view('backend.shift.edit')->withShift($shift);
    }

    /**
     * @param UpdateShiftRequest $request
     * @param Shift              $shift
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        $shift = $this->shiftRepository->update($shift, $request->only(
            'name',
            'time_start',
            'time_end'
        ));

        return redirect()->route('admin.shift.index')->withFlashSuccess(__('alerts.backend.shifts.updated', ['shift' => $shift->name]));
    }

    /**
     * @param ManageShiftRequest $request
     * @param Shift              $shift
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageShiftRequest $request, Shift $shift)
    {
        $shift_name = $shift->name;
        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.shift.show', $shift->id)."'>".$shift->name.'</a>';

        $shift = $this->shiftRepository->deleteById($shift->id);

        event(new ShiftDeleted($auth_link, $asset_link));

        return redirect()->route('admin.shift.deleted')->withFlashSuccess(__('alerts.backend.shifts.deleted', ['shift' => $shift_name]));
    }
}
