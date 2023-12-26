<?php

namespace App\Repositories;

use App\Enums\MachineStatuses;
use App\Models\Machine;
use Illuminate\Http\Request;

class MachineRepository extends Repository
{
    public function model()
    {
        return Machine::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([
            'category_id' => $request->get('category_id'),
            'brand_id' => $request->get('brand_id'),
            'machine_model_id' => $request->get('machine_model_id'),
            'floor_id' => $request->get('floor_id'),
            'machine_number' => $request->get('machine_number'),
            'local_number' => $request->get('local_number'),
            'transmission_type' => $request->get('transmission_type'),
            'status' => $request->get('status'),
            'is_rented' => $request->get('is_rented')
        ]);
    }

    public function updateByRequest(Request $request, $machineId)
    {
        return $this->query()->findOrFail($machineId)?->update([
            'category_id' => $request->get('category_id'),
            'brand_id' => $request->get('brand_id'),
            'machine_model_id' => $request->get('machine_model_id'),
            'floor_id' => $request->get('floor_id'),
            'machine_number' => $request->get('machine_number'),
            'local_number' => $request->get('local_number'),
            'transmission_type' => $request->get('transmission_type'),
            'status' => $request->get('status'),
            'is_rented' => $request->get('is_rented')
        ]);
    }

    public function updateMachineStatus($machineId, MachineStatuses $condition): bool
    {
        return $this->query()
            ->findOrFail($machineId)
            ->update([
                'status' => $condition->value
            ]);
    }

    public function deleteByRequest($machineId)
    {
        return $this->query()->findOrFail($machineId)?->delete();
    }

}
