<?php

use App\Domains\ValueObjects\RGB;

describe('ValueObject - RGB', static function () {
    it(
        'TRUE cases',
        fn (int ...$value) => expect(
            RGB::make(...$value)->value
        )->toBe($value)
    )
        ->with([
            [255, 255, 255],
            [0, 0, 0],
            [100, 150, 200],
        ]);

    it(
        "FALSE case: -1",
        fn () => expect(
            RGB::make(0, 0, -1)
        )
    )->throws(RuntimeException::class);

    it(
        "FALSE case: 256",
        fn () => expect(
            RGB::make(256, 0, 0)
        )
    )->throws(RuntimeException::class);
});
