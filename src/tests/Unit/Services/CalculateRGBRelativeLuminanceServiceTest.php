<?php

use App\Services\CalculateRGBRelativeLuminance\CalculateRGBRelativeLuminanceService;

describe('CalculateRGBRelativeLuminanceService', static function () {
    $service = new CalculateRGBRelativeLuminanceService;

    it(
        'weightWithR',
        fn (int $input, float $expected) => expect(
            $service->weightWithR($input)
        )->toBe($expected)
    )
        ->with([
            [1, 0.2126],
            [0, 0],
        ]);

    it(
        'weightWithG',
        fn (int $input, float $expected) => expect(
            $service->weightWithG($input)
        )->toBe($expected)
    )
        ->with([
            [1, 0.7152],
            [0, 0],
        ]);

    it(
        'weightWithB',
        fn (int $input, float $expected) => expect(
            $service->weightWithB($input)
        )->toBe($expected)
    )
        ->with([
            [1, 0.0722],
            [0, 0],
        ]);
});
