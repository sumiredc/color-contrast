<?php

declare(strict_types=1);

namespace App\Domains\ValueObjects;

use RuntimeException;

readonly final class Hex
{
    private const HEX_PATTERN = '/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})/';

    /**
     * @param string $value
     */
    private function __construct(
        public readonly string $value
    ) {
    }

    /**
     * @param string $value
     * @return self
     * 
     * @throws RuntimeException
     */
    public static function make(string $value): self
    {
        $isMatch = preg_match(self::HEX_PATTERN, $value);
        if ($isMatch === 0) {
            throw new RuntimeException("Invalid value. [{$value}]");
        }

        return new self($value);
    }
}
