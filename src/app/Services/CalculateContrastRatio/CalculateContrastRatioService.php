<?php

declare(strict_types=1);

namespace App\Services\CalculateContrastRatio;

use App\Domains\ValueObjects\RelativeLuminance;

final class CalculateContrastRatioService implements CalculateContrastRatioServiceI
{
    /**
     * @param RelativeLuminance $r1
     * @param RelativeLuminance $r2
     * @return float
     */
    public function ratio(RelativeLuminance $r1, RelativeLuminance $r2): float
    {
        return floatval(($r1->value + 0.05) / ($r2->value + 0.05));
    }
}
