<?php

declare(strict_types=1);

namespace App\Services\CalculateRGBRelativeLuminance;

/**
 * @see https://www.w3.org/TR/WCAG22/#dfn-relative-luminance
 */
interface CalculateRGBRelativeLuminanceServiceI
{
    /**
     * @param float $rLinear
     * @return float
     */
    public function weightWithR(float $rLinear): float;

    /**
     * @param float $gLinear
     * @return float
     */
    public function weightWithG(float $gLinear): float;

    /**
     * @param float $bLinear
     * @return float
     */
    public function weightWithB(float $bLinear): float;
}
