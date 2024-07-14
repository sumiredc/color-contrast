<?php

use App\Rules\ColorCode\HexRule;

describe('HexRule - validate', static function () {
    $rule = new HexRule;

    it(
        'True cases',
        fn (string $colorCode) => expect($rule->validate($colorCode))->toBeTrue()
    )
        ->with([
            'white: lower case' => '#ffffff',
            'white: upper case' => '#FFFFFF',
            'white: short case' => '#FFF',
            'black' => '#000000',
            'black: short case' => '#000',
            '#1A2B3C',
            '#4D5E6F',
            '#789000',
            '#abcdef',
        ]);

    it(
        'False cases',
        fn (string $colorCode) => expect($rule->validate($colorCode))->toBeFalse()
    )
        ->with([
            'No hash' => 'ffffff',
            '#ggg',
            '#hhh',
            '#iii',
            '#jjj',
            '#kkk',
            '#lll',
            '#mmm',
            '#nnn',
            '#ooo',
            '#ppp',
            '#qqq',
            '#rrr',
            '#sss',
            '#ttt',
            '#uuu',
            '#vvv',
            '#www',
            '#xxx',
            '#yyy',
            '#zzz',
            '#GGG',
            '#HHH',
            '#III',
            '#JJJ',
            '#KKK',
            '#LLL',
            '#MMM',
            '#NNN',
            '#OOO',
            '#PPP',
            '#QQQ',
            '#RRR',
            '#SSS',
            '#TTT',
            '#UUU',
            '#VVV',
            '#WWW',
            '#XXX',
            '#YYY',
            '#ZZZ',
        ]);
});
