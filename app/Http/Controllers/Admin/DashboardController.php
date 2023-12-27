<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MachineStatuses;
use App\Http\Controllers\Controller;
use App\Repositories\MachineRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function __construct(
        protected MachineRepository $machineRepository
    )
    {}


    public function index()
    {
        $machines = $this->machineRepository->getAll();
        $runningCount = $machines->where('status', MachineStatuses::RUNNING->value)->count();
        $idleCount = $machines->where('status', MachineStatuses::IDLE->value)->count();
        $repairableCount = $machines->where('status', MachineStatuses::REPAIRABLE->value)->count();
        $disableCount = $machines->where('status', MachineStatuses::DISABLE->value)->count();

        return Inertia::render('Dashboard', [
            'running_count' => $runningCount,
            'idle_count' => $idleCount,
            'repairable_count' => $repairableCount,
            'disable_count' => $disableCount,
        ]);
    }
}
