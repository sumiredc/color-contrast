<?php

use App\Domains\ValueObjects\Hex;

describe('ValueObject - Hex', static function () {
    it(
        'TRUE cases',
        fn (string $code) => expect(
            Hex::make($code)->value
        )->toBe($code)
    )
        ->with([
            '#1A2B3C',
            '#4D5E6F',
            '#789000',
            '#abcdef',
            '#1A2',
            '#4D5',
            '#789',
            '#abc',
        ]);

    it(
        'FALSE case: ffffff',
        fn () => expect(
            Hex::make('ffffff')
        )
    )->throws(RuntimeException::class);
});
