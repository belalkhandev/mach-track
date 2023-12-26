<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MachineStatuses;
use App\Enums\TransmissionTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\MachineStoreRequest;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FloorRepository;
use App\Repositories\MachineModelRepository;
use App\Repositories\MachineRepository;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MachineController extends Controller
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected BrandRepository $brandRepository,
        protected MachineModelRepository $modelRepository,
        protected MachineRepository $machineRepository,
        protected FloorRepository $floorRepository,
        protected NoteRepository $noteRepository
    )
    {
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllByOrder('name');
        $brands = $this->brandRepository->getAllByOrder('name');
        $models = $this->modelRepository->getAllByOrder('name');
        $machines = $this->machineRepository->getLatestByPaginate(with: ['category', 'brand', 'machineModel']);
        $floors = $this->floorRepository->getAllByOrder('building_id', with: 'building');

        return Inertia::render('Machines', [
            'categories' => $categories,
            'brands' => $brands,
            'machine_models' => $models,
            'machines' => $machines,
            'transmission_types' => TransmissionTypes::values(),
            'machine_statuses' => MachineStatuses::values(),
            'floors' => $floors
        ]);
    }

    public function store(MachineStoreRequest $request)
    {
        $machine = $this->machineRepository->storeByRequest($request);

        if ($request->filled('note')) {
            $this->noteRepository->storeByRequest($request, $machine);
        }

        return to_route('machine.index');
    }

    public function update(MachineStoreRequest $request, $machineId)
    {
        $this->machineRepository->updateByRequest($request, $machineId);

        if ($request->filled('note')) {
            $machine = $this->machineRepository->findOrFail($machineId);
            $this->noteRepository->storeByRequest($request, $machine);
        }

        return to_route('machine.index');
    }

    public function destroy($machineId)
    {
        $this->machineRepository->deleteByRequest($machineId);

        return to_route('machine.index');
    }
}