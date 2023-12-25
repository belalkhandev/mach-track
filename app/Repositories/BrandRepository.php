<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandRepository extends Repository
{
    public function model()
    {
        return Brand::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function updateByRequest(Request $request, $brandId)
    {
        return $this->query()->findOrFail($brandId)?->update([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function deleteByRequest($brandId)
    {
        return $this->query()->findOrFail($brandId)?->delete();
    }

}
