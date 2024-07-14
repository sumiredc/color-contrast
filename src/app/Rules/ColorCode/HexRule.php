<?php

declare(strict_types=1);

namespace App\Rules\ColorCode;

final class HexRule implements HexRuleI
{
    /**
     * @param string $value
     * @return bool
     */
    public function validate(string $value): bool
    {
        $result = preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})/', $value);
        return boolval($result);
    }
}
