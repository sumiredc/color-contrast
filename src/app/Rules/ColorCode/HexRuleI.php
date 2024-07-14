<?php

declare(strict_types=1);

namespace App\Rules\ColorCode;

interface HexRuleI
{
    /**
     * @param string $value
     * @return bool
     */
    public function validate(string $value): bool;
}
