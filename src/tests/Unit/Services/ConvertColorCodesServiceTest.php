<?php

use App\Domains\ValueObjects\FullHex;
use App\Domains\ValueObjects\Hex;
use App\Services\ConvertColorCode\ConvertColorCodeService;

describe('ConvertColorCodeService', static function () {
    $service = new ConvertColorCodeService;

    describe('fullHex', static function () use ($service) {
        it(
            'Short size -> Full size',
            fn (Hex $input, string $expected) => expect(
                $service->fullHex($input)->value
            )->toBe($expected)
        )
            ->with([
                [Hex::make('#fff'), '#ffffff'],
                [Hex::make('#ABC'), '#AABBCC'],
            ]);

        it(
            'Full size -> Full size',
            fn (Hex $input, string $expected) => expect(
                $service->fullHex($input)->value
            )->toBe($expected)
        )
            ->with([
                [Hex::make('#ffffff'), '#ffffff'],
                [Hex::make('#ABCABC'), '#ABCABC'],
            ]);
    });

    it(
        'hexToRGB',
        fn (FullHex $input, array $expected) => expect(
            $service->hexToRGB($input)->value
        )->toBe($expected)
    )
        ->with([
            [FullHex::make('#FFFFFF'), [255, 255, 255]],
            [FullHex::make('#000000'), [0, 0, 0]],
            [FullHex::make('#AABBCC'), [170, 187, 204]],
            [FullHex::make('#abcdef'), [171, 205, 239]],
        ]);

    it(
        'srgbTo8bit',
        fn (int $sRGB, float $expected) => expect(
            $service->srgbTo8bit($sRGB)
        )->toBe($expected)
    )
        ->with([
            [255, 1.0],
            [0, 0.0],
            [120, 0.47058823529411764],
        ]);

    it(
        'eightBitToLinear',
        fn (float $color8bit, float $expected) => expect(
            $service->eightBitToLinear($color8bit)
        )->toBe($expected)
    )
        ->with([
            [1.0, 1.0],
            [0, 0],
            [0.04045, 0.0031308049535603713],
            [0.04046, 0.003131594552688991]
        ]);
});
