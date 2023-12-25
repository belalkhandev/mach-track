<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MachineModelRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MachineModelController extends Controller
{
    public function __construct(
        protected MachineModelRepository $machineModelRepository
    )
    {
    }

    public function index()
    {
        $machineModels = $this->machineModelRepository->getByPaginate();

        return Inertia::render('Models', [
            'machine_models' => $machineModels
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:machine_models,name'],
        ]);

        $this->machineModelRepository->storeByRequest($request);

        return to_route('machine.model.index');
    }

    public function update(Request $request, $machienModelId)
    {
        $request->validate([
            'name' => ['required', 'unique:machine_models,name,'.$machienModelId],
        ]);

        $this->machineModelRepository->updateByRequest($request, $machienModelId);

        return to_route('machine.model.index');
    }

    public function destroy($machienModelId)
    {
        $this->machineModelRepository->deleteByRequest($machienModelId);

        return to_route('machine.model.index');
    }
}
