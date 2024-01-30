<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MachineStatuses;
use App\Enums\TransmissionTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\MachineStoreRequest;
use App\Http\Requests\MachineUpdateRequest;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FloorRepository;
use App\Repositories\MachineModelRepository;
use App\Repositories\MachineRepository;
use App\Repositories\NoteRepository;
use App\Services\Exporter\MachineExport;
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

    public function index(Request $request)
    {
        $categories = $this->categoryRepository->getAllByOrder('name');
        $brands = $this->brandRepository->getAllByOrder('name');
        $models = $this->modelRepository->getAllByOrder('name');

        $machines = $this->machineRepository->getAllByPaginate($request);

        $floors = $this->floorRepository->getAllByOrder('building_id', with: 'building');

        return Inertia::render('Machine/Index', [
            'categories' => $categories,
            'brands' => $brands,
            'machine_models' => $models,
            'machines' => $machines,
            'transmission_types' => TransmissionTypes::values(),
            'machine_statuses' => MachineStatuses::values(),
            'floors' => $floors,
            'filtering_data' => $request
        ]);
    }

    public function show($machineId)
    {
        $machine = $this->machineRepository->query()
            ->with([
                'category',
                'brand',
                'machineModel',
                'floor',
                'floor.building',
                'notes'
            ])
            ->findOrFail($machineId);

        return Inertia::render('Machine/Show', [
           'machine' => $machine
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

    public function update(MachineUpdateRequest $request, $machineId)
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
    }

    public function export(Request $request, MachineExport $export)
    {
        $machines = $this->machineRepository->getAllForExport($request);

        return $export->exportPDF($machines);
    }
}
