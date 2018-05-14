<?php

namespace App\Http\Controllers\Backend\Shift;

use App\Models\Shift\Shift;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Shift\ShiftRepository;
use App\Http\Requests\Backend\Shift\ManageShiftRequest;

/**
 * Class ShiftStatusController.
 */
class ShiftStatusController extends Controller
{
    /**
     * @var ShiftRepository
     */
    protected $shiftRepository;

    /**
     * @param ShiftRepository $shiftRepository
     */
    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepository = $shiftRepository;
    }

    /**
     * @param ManageShiftRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageShiftRequest $request)
    {
        return view('backend.shift.deleted')
            ->withShifts($this->shiftRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageShiftRequest $request
     * @param Shift              $deletedShift
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageShiftRequest $request, Shift $deletedShift)
    {
        $shift = $this->shiftRepository->forceDelete($deletedShift);

        return redirect()->route('admin.shift.deleted')->withFlashSuccess(__('alerts.backend.shifts.deleted_permanently', ['shift' => $deletedShift->name]));
    }

    /**
     * @param ManageShiftRequest $request
     * @param Shift              $deletedShift
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageShiftRequest $request, Shift $deletedShift)
    {
        $shift = $this->shiftRepository->restore($deletedShift);

        return redirect()->route('admin.shift.index')->withFlashSuccess(__('alerts.backend.shifts.restored', ['shift' => $shift->name]));
    }
}
