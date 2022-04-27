<?php

namespace App\Command\Laravel;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class PasswordGenerateCommand extends Command
{
    protected static $defaultName = 'laravel:password';

    protected function configure(): void
    {
        $this
            ->addArgument('password', InputArgument::REQUIRED, 'Enter the password')
            ->setDescription('Create hash from your password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $password = $input->getArgument('password');
        $output->writeln('<info>' . password_hash($password, PASSWORD_BCRYPT) . '</info>');
        return Command::SUCCESS;
    }
}
