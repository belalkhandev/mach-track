<?php

namespace App\Repositories;

use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingRepository extends Repository
{
    public function model()
    {
        return Tracking::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([

        ]);
    }

    public function updateByRequest(Request $request, $trackingId)
    {
        return $this->query()->findOrFail($trackingId)?->update([

        ]);
    }

    public function deleteByRequest($trackingId)
    {
        return $this->query()->findOrFail($trackingId)?->delete();
    }

}
