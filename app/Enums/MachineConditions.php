<?php

namespace App\Enums;

use App\Enums\Concerns\EnumAttributes;

enum MachineConditions: string
{
    use EnumAttributes;

    case RUNNING = 'running';
    case IDLE = 'idle';
    case REPAIRABLE = 'repairable';
    case DISABLE = 'disable';

}
