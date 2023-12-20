<?php

namespace App\Domains\Common\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self ASC()
 * @method static self DESC()
 */
class Sort extends Enum
{
    const ASC = 'asc';
    const DESC = 'desc';
}