<?php

namespace App\Repositories;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorRepository extends Repository
{
    public function model()
    {
        return Floor::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([
            'name' => $request->get('name'),
            'building_id' => $request->get('building_id'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function updateByRequest(Request $request, $floorId)
    {
        return $this->query()->findOrFail($floorId)?->update([
            'name' => $request->get('name'),
            'building_id' => $request->get('building_id'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function deleteByRequest($floorId)
    {
        return $this->query()->findOrFail($floorId)?->delete();
    }

}
