<?php

declare(strict_types=1);

namespace App\Domains\ValueObjects;

use RuntimeException;

/**
 * @property-read string $value
 */
readonly final class RGB
{
    /**
     * @param int $r
     * @param int $g
     * @param int $b
     */
    private function __construct(
        public readonly int $r,
        public readonly int $g,
        public readonly int $b,
    ) {
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     * @return self
     * 
     * @throws RuntimeException
     */
    public static function make(int $r, int $g, int $b): self
    {
        try {
            self::validate($r);
            self::validate($g);
            self::validate($b);
        } catch (RuntimeException) {
            throw new RuntimeException("Invalid value. [R:{$r}, G:{$g}, B:{$b}]");
        }

        return new self($r, $g, $b);
    }

    /**
     * @param int $value
     * @return void
     * 
     * @throws RuntimeException
     */
    private static function validate(int $value): void
    {
        if ($value < 0 || $value > 255) {
            throw new RuntimeException("Invalid value. [{$value}]");
        }
    }

    /**
     * @param string $name
     * @return mixed
     * 
     * @throws RuntimeException
     */
    public function __get(string $name): mixed
    {
        return match ($name) {
            'value' => [$this->r, $this->g, $this->b],
            default => new RuntimeException("Access to this property is denied. [{$name}]"),
        };
    }
}
