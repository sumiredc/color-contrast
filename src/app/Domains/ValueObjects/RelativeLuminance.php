<?php

declare(strict_types=1);

namespace App\Domains\ValueObjects;

use RuntimeException;

readonly final class RelativeLuminance
{
    /**
     * @param float $value
     */
    private function __construct(
        public readonly float $value,
    ) {
    }

    /**
     * @param float $value
     * @return self
     * 
     * @throws RuntimeException
     */
    public static function make(float $value): self
    {
        if ($value < 0 || $value > 1) {
            throw new RuntimeException("Invalid value. [{$value}]");
        }

        return new self($value);
    }
}
