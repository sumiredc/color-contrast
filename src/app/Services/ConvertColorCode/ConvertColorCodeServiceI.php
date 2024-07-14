<?php

declare(strict_types=1);

namespace App\Services\ConvertColorCode;

use App\Domains\ValueObjects\FullHex;
use App\Domains\ValueObjects\Hex;
use App\Domains\ValueObjects\RGB;

interface ConvertColorCodeServiceI
{
    /**
     * #ABC -> #AABBCC
     *
     * @param Hex $hex
     * @return FullHex
     */
    public function fullHex(Hex $hex): FullHex;

    /**
     * #FFFFFF -> [255, 255, 255]
     * 
     * @param FullHex $hex
     * @return RGB
     */
    public function hexToRGB(FullHex $hex): RGB;

    /**
     * n / 255
     *
     * @param int $sRGB
     * @return float
     */
    public function srgbTo8bit(int $sRGB): float;

    /**
     * 8bit値をリニアRGB値に変換
     * 
     * @param float $color8bit
     * @return float
     */
    public function eightBitToLinear(float $color8bit): float;
}
