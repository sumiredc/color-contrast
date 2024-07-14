<?php

declare(strict_types=1);

namespace App\Commands;

use App\InterfaceAdapter\InputColorCode;
use App\Presenters\ContrastPresenter;
use App\Rules\ColorCode\HexRule;
use App\Services\CalculateContrastRatio\CalculateContrastRatioService;
use App\Services\CalculateRGBRelativeLuminance\CalculateRGBRelativeLuminanceService;
use App\Services\ConvertColorCode\ConvertColorCodeService;
use App\Usecases\AccessibilityLevelCalculator\AccessibilityLevelCalculator;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'contrast:check',
    description: '色のコントラスト比較を算出します',
)]
final class ContrastCheckCommand extends Command
{
    protected function configure(): void
    {
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);

        $inputColorCode = new InputColorCode($io, new HexRule);
        $colorCode1 = $inputColorCode->ask();
        $colorCode2 = $inputColorCode->ask('Input the color code you want to compare. (ex: #ffffff)');

        try {
            $usecase = new AccessibilityLevelCalculator(
                new ConvertColorCodeService,
                new CalculateRGBRelativeLuminanceService,
                new CalculateContrastRatioService
            );

            $ratio = $usecase($colorCode1, $colorCode2);

            $presenter = new ContrastPresenter($io);
            $presenter->output($ratio);

            return Command::SUCCESS;
        } catch (Exception $ex) {
            $io->error($ex->getMessage());
            return Command::FAILURE;
        }
    }
}
