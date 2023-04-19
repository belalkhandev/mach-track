<?php

namespace App\Repositories\User;

use App\Models\Role;
use App\Repositories\Repository;

class RoleRepository extends Repository
{
    public function model()
    {
        return Role::class;
    }
}
