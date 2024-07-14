<?php

declare(strict_types=1);

namespace App\Usecases\AccessibilityLevelCalculator;

use App\Domains\ValueObjects\Hex;
use App\Domains\ValueObjects\RelativeLuminance;
use App\Services\CalculateContrastRatio\CalculateContrastRatioServiceI;
use App\Services\CalculateRGBRelativeLuminance\CalculateRGBRelativeLuminanceServiceI;
use App\Services\ConvertColorCode\ConvertColorCodeServiceI;

final class AccessibilityLevelCalculator implements AccessibilityLevelCalculatorI
{
    /**
     * @param ConvertColorCodeServiceI $convertColorCodeService
     * @param CalculateRGBRelativeLuminanceServiceI $calculateRGBRelativeLuminanceService
     * @param CalculateContrastRatioServiceI $calculateContrastRatioService
     */
    public function __construct(
        private readonly ConvertColorCodeServiceI $convertColorCodeService,
        private readonly CalculateRGBRelativeLuminanceServiceI $calculateRGBRelativeLuminanceService,
        private readonly CalculateContrastRatioServiceI $calculateContrastRatioService
    ) {
    }

    /**
     * @param string $colorCode1
     * @param string $colorCode2
     * @return float
     */
    public function __invoke(string $colorCode1, string $colorCode2): float
    {
        $relativeLuminance1 = $this->calRelativeLuminance($colorCode1);
        $relativeLuminance2 = $this->calRelativeLuminance($colorCode2);

        [$l1, $l2] = $relativeLuminance1->value > $relativeLuminance2->value
            ? [$relativeLuminance1, $relativeLuminance2]
            : [$relativeLuminance2, $relativeLuminance1];

        return $this->calculateContrastRatioService->ratio($l1, $l2);
    }

    /**
     * @param string $colorCode
     * @return RelativeLuminance
     */
    private function calRelativeLuminance(string $colorCode): RelativeLuminance
    {
        $hex = Hex::make($colorCode);
        $fullHex = $this->convertColorCodeService->fullHex($hex);

        $rgb = $this->convertColorCodeService
            ->hexToRGB($fullHex);

        // R
        $rLinear = $this->convertSrgbToLinear($rgb->r);
        $rWithWeight = $this->calculateRGBRelativeLuminanceService
            ->weightWithR($rLinear);

        // G
        $gLinear = $this->convertSrgbToLinear($rgb->g);
        $gWithWeight = $this->calculateRGBRelativeLuminanceService
            ->weightWithG($gLinear);

        // B
        $bLinear = $this->convertSrgbToLinear($rgb->b);
        $bWithWeight = $this->calculateRGBRelativeLuminanceService
            ->weightWithB($bLinear);

        return RelativeLuminance::make(floatval($rWithWeight + $gWithWeight + $bWithWeight));
    }

    /**
     * @param int $srgb
     * @return float
     */
    private function convertSrgbToLinear(int $srgb): float
    {
        $color8bit = $this->convertColorCodeService->srgbTo8bit($srgb);
        return $this->convertColorCodeService->eightBitToLinear($color8bit);
    }
}
