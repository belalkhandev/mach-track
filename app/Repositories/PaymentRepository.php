<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository extends Repository
{
    public function model()
    {
        return Payment::class;
    }
}
