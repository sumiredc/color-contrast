<?php

declare(strict_types=1);

namespace App\InterfaceAdapter;

use App\Rules\ColorCode\HexRuleI;
use RuntimeException;
use Symfony\Component\Console\Style\SymfonyStyle;

final class InputColorCode
{
    /**
     * @param SymfonyStyle $io
     * @param HexRuleI $rule
     */
    public function __construct(
        private SymfonyStyle $io,
        private HexRuleI $rule
    ) {
    }

    /**
     * @param string $question
     * @return string
     * 
     * @throws RuntimeException
     */
    public function ask(
        string $question = 'Input the color code. (ex: #ffffff)'
    ): string {
        $input = '';
        do {
            $input = $this->format($this->io->ask($question));
        } while (!$this->validate($input));

        return $input;
    }

    /**
     * @param mixed $input
     * @return string
     * 
     * @throws RuntimeException
     */
    private function format(mixed $input): string
    {
        if (!is_string($input)) {
            throw new RuntimeException("The input is not a string.");
        }
        return $input;
    }

    /**
     * @param string $input
     * @return bool
     */
    private function validate(string $input): bool
    {
        if (!$this->rule->validate($input)) {
            $this->io->error('Invalid color code format. (ex: #ffffff, #000)');
            return false;
        }

        return true;
    }
}
