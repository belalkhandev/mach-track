<?php

namespace App\Repositories\User;

use App\Models\Permission;
use App\Repositories\Repository;

class PermissionRepository extends Repository
{
    public function model()
    {
        return Permission::class;
    }
}
