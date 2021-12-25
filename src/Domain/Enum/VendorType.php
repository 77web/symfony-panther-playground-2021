<?php
declare(strict_types=1);

namespace App\Domain\Enum;

enum VendorType: string
{
    case SEARCH = 'search';
    case DISPLAY = 'display';
    case SNS = 'sns';
}
