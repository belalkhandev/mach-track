<?php

namespace App\Repositories;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingRepository extends Repository
{
    public function model()
    {
        return Building::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function updateByRequest(Request $request, $buildingId)
    {
        return $this->query()->findOrFail($buildingId)?->update([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function deleteByRequest($buildingId)
    {
        return $this->query()->findOrFail($buildingId)?->delete();
    }

}
