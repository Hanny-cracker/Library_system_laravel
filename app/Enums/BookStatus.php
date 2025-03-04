<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BookStatus extends Enum
{
    const AVAILABLE = 'Available';
    // const BORROWED = 'borrowed';
    const OUT_OF_STOCK = 'Out Of Stock';
}