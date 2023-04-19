<?php

namespace App\Repositories\Package;

use App\Models\PackageCategoryPackage;
use App\Repositories\Repository;

class PackageCategoryRepository extends Repository
{
    public function model()
    {
        return PackageCategoryPackage::class;
    }
}
