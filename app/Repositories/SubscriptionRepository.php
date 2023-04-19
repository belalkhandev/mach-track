<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository extends Repository
{
    public function model()
    {
        return Subscription::class;
    }
}
