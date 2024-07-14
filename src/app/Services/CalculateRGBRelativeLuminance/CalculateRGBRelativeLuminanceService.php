<?php

declare(strict_types=1);

namespace App\Services\CalculateRGBRelativeLuminance;

final class CalculateRGBRelativeLuminanceService implements CalculateRGBRelativeLuminanceServiceI
{
    private const R_WEIGHT = 0.2126;
    private const G_WEIGHT = 0.7152;
    private const B_WEIGHT = 0.0722;

    /**
     * @param float $rLinear
     * @return float
     */
    public function weightWithR(float $rLinear): float
    {
        return self::R_WEIGHT * $rLinear;
    }

    /**
     * @param float $gLinear
     * @return float
     */
    public function weightWithG(float $gLinear): float
    {
        return self::G_WEIGHT * $gLinear;
    }

    /**
     * @param float $bLinear
     * @return float
     */
    public function weightWithB(float $bLinear): float
    {
        return self::B_WEIGHT * $bLinear;
    }
}
