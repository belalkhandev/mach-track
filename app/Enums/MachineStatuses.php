<?php

namespace App\Enums;

use App\Enums\Concerns\EnumAttributes;

enum MachineStatuses: string
{
    use EnumAttributes;

    case RUNNING = 'running';
    case IDLE = 'idle';
    case REPAIRABLE = 'repairable';
    case DISABLE = 'disable';

}
