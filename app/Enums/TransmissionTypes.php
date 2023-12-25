<?php

namespace App\Enums;

use App\Enums\Concerns\EnumAttributes;

enum TransmissionTypes: string
{
    use EnumAttributes;

    case AUTO = 'auto';
    case MANUAL = 'manual';

}
