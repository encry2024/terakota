<?php

namespace App\Http\Controllers\Backend\Dining;

use App\Models\Dining\Dining;
use App\Http\Controllers\Controller;
use App\Events\Backend\Dining\DiningDeleted;
use App\Repositories\Backend\Dining\DiningRepository;
use App\Http\Requests\Backend\Dining\StoreDiningRequest;
use App\Http\Requests\Backend\Dining\ManageDiningRequest;
use App\Http\Requests\Backend\Dining\UpdateDiningRequest;
use Auth;
use App\Models\Auth\User;

/**
 * Class DiningController.
 */
class DiningController extends Controller
{
    /**
     * @var DiningRepository
     */
    protected $diningRepository;

    /**
     * DiningController constructor.
     *
     * @param DiningRepository $diningRepository
     */
    public function __construct(DiningRepository $diningRepository)
    {
        $this->diningRepository = $diningRepository;
    }

    /**
     * @param ManageDiningRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageDiningRequest $request)
    {
        return view('backend.dining.index')
            ->withDinings($this->diningRepository->getDiningPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageDiningRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageDiningRequest $request)
    {
        return view('backend.dining.create');
    }

    /**
     * @param StoreDiningRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreDiningRequest $request)
    {
        $dining = $this->diningRepository->create($request->only(
            'name',
            'price',
            'description'
        ));

        return redirect()->route('admin.dining.index')->withFlashSuccess(__('alerts.backend.dinings.created', ['dining' => $dining->name]));
    }

    /**
     * @param ManageDiningRequest $request
     * @param Dining              $dining
     *
     * @return mixed
     */
    public function show(ManageDiningRequest $request, Dining $dining)
    {
        return view('backend.dining.show')
            ->withDining($dining);
    }

    /**
     * @param ManageDiningRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param Dining                 $dining
     *
     * @return mixed
     */
    public function edit(ManageDiningRequest $request, Dining $dining)
    {
        return view('backend.dining.edit')->withDining($dining);
    }

    /**
     * @param UpdateDiningRequest $request
     * @param Dining              $dining
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateDiningRequest $request, Dining $dining)
    {
        $dining = $this->diningRepository->update($dining, $request->only(
            'name',
            'price',
            'description'
        ));

        return redirect()->route('admin.dining.index')->withFlashSuccess(__('alerts.backend.dinings.updated', ['dining' => $dining->name]));
    }

    /**
     * @param ManageDiningRequest $request
     * @param Dining              $dining
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageDiningRequest $request, Dining $dining)
    {
        $dining_name = $dining->name;
        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.dining.show', $dining->id)."'>".$dining->name.'</a>';

        $dining = $this->diningRepository->deleteById($dining->id);

        event(new DiningDeleted($auth_link, $asset_link));

        return redirect()->route('admin.dining.deleted')->withFlashSuccess(__('alerts.backend.dinings.deleted', ['dining' => $dining_name]));
    }
}
