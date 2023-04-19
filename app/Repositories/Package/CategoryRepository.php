<?php

namespace App\Repositories\Package;

use App\Models\PackageCategory;
use App\Repositories\Repository;

class CategoryRepository extends Repository
{
    public function model()
    {
        return PackageCategory::class;
    }
}
