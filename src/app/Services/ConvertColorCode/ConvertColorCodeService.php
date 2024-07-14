<?php

declare(strict_types=1);

namespace App\Services\ConvertColorCode;

use App\Domains\ValueObjects\FullHex;
use App\Domains\ValueObjects\Hex;
use App\Domains\ValueObjects\RGB;
use RuntimeException;

final class ConvertColorCodeService implements ConvertColorCodeServiceI
{
    private const HEX_FULL_LENGTH = 7;
    private const HEX_SHORT_LENGTH = 4;

    /**
     * @param Hex $hex
     * @return FullHex
     * 
     * @throws RuntimeException
     */
    public function fullHex(Hex $hex): FullHex
    {
        $shortColorCodePattern = '/^#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/';

        $fullHexCode = match (mb_strlen($hex->value)) {
            self::HEX_FULL_LENGTH => $hex->value,
            self::HEX_SHORT_LENGTH => preg_replace($shortColorCodePattern, "#$1$1$2$2$3$3", $hex->value),
            default => throw new RuntimeException("Invalid value. [{$hex->value}]"),
        };

        if (!is_string($fullHexCode)) {
            throw new RuntimeException("Invalid value. [{$hex->value}]");
        }

        return FullHex::make($fullHexCode);
    }

    /**
     * @param FullHex $hex
     * @return RGB
     * 
     * @throws RuntimeException
     */
    public function hexToRGB(FullHex $hex): RGB
    {
        $fullColorCodePattern = '/^#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/';

        $matchValues = ['', '', '', ''];
        $isMatch = preg_match($fullColorCodePattern, $hex->value, $matchValues);
        if ($isMatch === 0) {
            throw new RuntimeException("Invalid value. [{$hex->value}]");
        }

        list(, $r, $g, $b) = $matchValues;
        return RGB::make(
            intval(hexdec($r)),
            intval(hexdec($g)),
            intval(hexdec($b))
        );
    }

    /**
     * @param int $sRGB
     * @return float
     */
    public function srgbTo8bit(int $sRGB): float
    {
        return floatval($sRGB / 255);
    }

    /**
     * @param float $color8bit
     * @return float
     */
    public function eightBitToLinear(float $color8bit): float
    {
        $borderValue = 0.04045;

        if ($color8bit <= $borderValue) {
            return $this->calLessValue($color8bit);
        }
        return $this->calGreaterOrEqualValue($color8bit);
    }

    /**
     * @param float $color8bit
     * @return float
     */
    private function calLessValue(float $color8bit): float
    {
        return floatval($color8bit / 12.92);
    }

    /**
     * @param float $color8bit
     * @return float
     */
    private function calGreaterOrEqualValue(float $color8bit): float
    {
        return floatval((($color8bit + 0.055) / 1.055) ** 2.4);
    }
}
