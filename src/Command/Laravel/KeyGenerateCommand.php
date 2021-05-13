<?php

namespace App\Command\Laravel;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class KeyGenerateCommand extends Command
{
    protected static $defaultName = 'laravel:key';

    protected function configure(): void
    {
        $this->setDescription('Create new random string of 32 characters');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $random32 = \Illuminate\Support\Str::random(32);
        $output->writeln("<info>$random32</info>");
        return Command::SUCCESS;
    }
}