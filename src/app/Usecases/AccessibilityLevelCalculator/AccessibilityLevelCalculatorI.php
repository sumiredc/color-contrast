<?php

declare(strict_types=1);

namespace App\Usecases\AccessibilityLevelCalculator;

interface AccessibilityLevelCalculatorI
{
    /**
     * @param string $colorCode1 ex: #FFFFFF
     * @param string $colorCode2 ex: #FFFFFF
     * @return void
     */
    public function __invoke(string $colorCode1, string $colorCode2);
}
