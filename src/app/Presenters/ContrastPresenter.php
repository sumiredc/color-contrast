<?php

declare(strict_types=1);

namespace App\Presenters;

use Symfony\Component\Console\Style\SymfonyStyle;

final class ContrastPresenter
{
    private const PRECISION = 2;

    /**
     * @param SymfonyStyle $io
     */
    public function __construct(
        private SymfonyStyle $io
    ) {
    }

    /**
     * @param float $ratio
     * @return void
     */
    public function output(float $ratio): void
    {
        $outputRatio = round($ratio, self::PRECISION);
        $this->io->success("1 : {$outputRatio}");
    }
}
