<?php

namespace App\Services\Exporter;

use Barryvdh\DomPDF\Facade\Pdf;

class MachineExport
{
    public function exportPDF($machines)
    {
        $pdf = Pdf::loadView('exports.machines', [
                'machines' => $machines,
            ])
            ->setPaper('a4', 'landscape');

        return $pdf->download('machine-reports-'.now('Asia/Dhaka')->format('Y-m-d-h-i-s').'.pdf');
    }
}
