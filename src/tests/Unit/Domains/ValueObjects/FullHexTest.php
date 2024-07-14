<?php

use App\Domains\ValueObjects\FullHex;

describe('ValueObject - FullHex', static function () {
    it(
        'TRUE cases',
        fn (string $code) => expect(
            FullHex::make($code)->value
        )->toBe($code)
    )
        ->with([
            '#1A2B3C',
            '#4D5E6F',
            '#789000',
            '#abcdef',
        ]);

    it(
        'FALSE case: ffffff',
        fn () => expect(
            FullHex::make('ffffff')
        )
    )->throws(RuntimeException::class);
});
