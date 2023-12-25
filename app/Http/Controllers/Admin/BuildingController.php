<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BuildingRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BuildingController extends Controller
{
    public function __construct(
        protected BuildingRepository $buildingRepository
    )
    {
    }

    public function index()
    {
        $buildings = $this->buildingRepository->getByPaginate();

        return Inertia::render('Buildings', [
            'buildings' => $buildings
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:buildings,name'],
        ]);

        $this->buildingRepository->storeByRequest($request);

        return to_route('building.index');
    }

    public function update(Request $request, $buildingId)
    {
        $request->validate([
            'name' => ['required', 'unique:buildings,name,'.$buildingId],
        ]);

        $this->buildingRepository->updateByRequest($request, $buildingId);

        return to_route('building.index');
    }

    public function destroy($buildingId)
    {
        $this->buildingRepository->deleteByRequest($buildingId);

        return to_route('building.index');
    }
}
