<?php

namespace App\Repositories\Package;

use App\Models\Package;
use App\Repositories\Repository;

class PackageRepository extends Repository
{
    public function model()
    {
        return Package::class;
    }

}
