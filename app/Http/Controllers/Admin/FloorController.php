<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BuildingRepository;
use App\Repositories\FloorRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FloorController extends Controller
{
    public function __construct(
        protected FloorRepository $floorRepository,
        protected BuildingRepository $buildingRepository,
    )
    {
    }

    public function index()
    {
        $floors = $this->floorRepository->getByPaginate(with: 'building');
        $buildings = $this->buildingRepository->getAllByOrder('name',);

        return Inertia::render('Floors', [
            'floors' => $floors,
            'buildings' => $buildings
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'building_id' => ['required'],
        ]);

        $this->floorRepository->storeByRequest($request);

        return to_route('floor.index');
    }

    public function update(Request $request, $floorId)
    {
        $request->validate([
            'name' => ['required'],
            'building_id' => ['required'],
        ]);

        $this->floorRepository->updateByRequest($request, $floorId);

        return to_route('floor.index');
    }

    public function destroy($floorId)
    {
        $this->floorRepository->deleteByRequest($floorId);

        return to_route('floor.index');
    }
}
