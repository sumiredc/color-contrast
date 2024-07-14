<?php

use App\Services\CalculateContrastRatio\CalculateContrastRatioService;
use App\Services\CalculateRGBRelativeLuminance\CalculateRGBRelativeLuminanceService;
use App\Services\ConvertColorCode\ConvertColorCodeService;
use App\Usecases\AccessibilityLevelCalculator\AccessibilityLevelCalculator;

describe('AccessibilityLevelCalculator', static function () {
    $usecase = new AccessibilityLevelCalculator(
        new ConvertColorCodeService,
        new CalculateRGBRelativeLuminanceService,
        new CalculateContrastRatioService
    );

    it(
        'Check color contrast',
        fn (string $colorCode1, string $colorCode2, float $expected) => expect(
            $usecase($colorCode1, $colorCode2)
        )->toBe($expected)
    )
        ->with([
            ['#FFFFFF', '#000000', 21],
            ['#595959', '#FDE5E7', 5.850002354518831],
            ['#FDE5E7', '#228b22', 3.665878526192358],
        ]);
});
