<?php

declare(strict_types=1);

namespace App\Services\CalculateContrastRatio;

use App\Domains\ValueObjects\RelativeLuminance;

/**
 * @see https://www.w3.org/TR/WCAG22/#dfn-contrast-ratio
 */
interface CalculateContrastRatioServiceI
{
    /**
     * @param RelativeLuminance $r1
     * @param RelativeLuminance $r2
     * @return float
     */
    public function ratio(RelativeLuminance $r1, RelativeLuminance $r2): float;
}
