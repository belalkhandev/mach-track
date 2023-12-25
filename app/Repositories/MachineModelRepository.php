<?php

namespace App\Repositories;

use App\Models\MachineModel;
use Illuminate\Http\Request;

class MachineModelRepository extends Repository
{
    public function model()
    {
        return MachineModel::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function updateByRequest(Request $request, $machineModelId)
    {
        return $this->query()->findOrFail($machineModelId)?->update([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function deleteByRequest($machineModelId)
    {
        return $this->query()->findOrFail($machineModelId)?->delete();
    }

}
