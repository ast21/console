<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Random extends Command
{
    protected static $defaultName = 'random';

    protected function configure(): void
    {
        $this
            ->addArgument('length', InputArgument::REQUIRED, 'Enter length')
            ->setDescription('Create new random string');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $length = $input->getArgument('length');
        $randomString = \Illuminate\Support\Str::random($length);
        $output->writeln("<info>$randomString</info>");
        return Command::SUCCESS;
    }
}