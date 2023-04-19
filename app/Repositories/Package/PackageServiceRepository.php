<?php

namespace App\Repositories\Package;

use App\Models\PackageService;
use App\Repositories\Repository;

class PackageServiceRepository extends Repository
{
    public function model()
    {
        return PackageService::class;
    }
}
