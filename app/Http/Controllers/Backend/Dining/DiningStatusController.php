<?php

namespace App\Http\Controllers\Backend\Dining;

use App\Models\Dining\Dining;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Dining\DiningRepository;
use App\Http\Requests\Backend\Dining\ManageDiningRequest;

/**
 * Class DiningStatusController.
 */
class DiningStatusController extends Controller
{
    /**
     * @var DiningRepository
     */
    protected $diningRepository;

    /**
     * @param DiningRepository $diningRepository
     */
    public function __construct(DiningRepository $diningRepository)
    {
        $this->diningRepository = $diningRepository;
    }

    /**
     * @param ManageDiningRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageDiningRequest $request)
    {
        return view('backend.dining.deleted')
            ->withDinings($this->diningRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageDiningRequest $request
     * @param Dining              $deletedDining
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageDiningRequest $request, Dining $deletedDining)
    {
        $dining = $this->diningRepository->forceDelete($deletedDining);

        return redirect()->route('admin.dining.deleted')->withFlashSuccess(__('alerts.backend.dinings.deleted_permanently', ['dining' => $deletedDining->name]));
    }

    /**
     * @param ManageDiningRequest $request
     * @param Dining              $deletedDining
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageDiningRequest $request, Dining $deletedDining)
    {
        $dining = $this->diningRepository->restore($deletedDining);

        return redirect()->route('admin.dining.index')->withFlashSuccess(__('alerts.backend.dinings.restored', ['dining' => $dining->name]));
    }
}
