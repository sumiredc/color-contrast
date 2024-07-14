<?php

use App\Domains\ValueObjects\RelativeLuminance;

describe('ValueObject - RelativeLuminance', static function () {
    it(
        'TRUE cases',
        fn (float $value) => expect(
            RelativeLuminance::make($value)->value
        )->toBe($value)
    )
        ->with([
            0.1,
            0.23456789,
            1.000,
        ]);

    it(
        "FALSE case: 1.1",
        fn () => expect(
            RelativeLuminance::make(1.1)
        )
    )->throws(RuntimeException::class);

    it(
        "FALSE case: -0.1",
        fn () => expect(
            RelativeLuminance::make(-0.1)
        )
    )->throws(RuntimeException::class);
});
