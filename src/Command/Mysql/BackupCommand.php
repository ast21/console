<?php

namespace App\Command\Mysql;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class BackupCommand extends Command
{
    protected static $defaultName = 'mysql:backup';

    protected function configure(): void
    {
        $this
            ->addArgument('database', InputArgument::REQUIRED, 'Enter the database')
            ->addArgument('username', InputArgument::OPTIONAL, 'Enter the username')
            ->addArgument('host', InputArgument::OPTIONAL, 'Enter the host')
            ->addArgument('port', InputArgument::OPTIONAL, 'Enter the port')
            ->addArgument('path', InputArgument::OPTIONAL, 'Enter the backup path')
            ->setDescription('Mysql dump database in this folder');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $HOST = $input->getArgument('username') ?? '127.0.0.1';
        $PORT = $input->getArgument('username') ?? '3306';
        $USERNAME = $input->getArgument('username') ?? 'root';
        $DATABASE = $input->getArgument('database');
        $BACKUP_PATH = date("Y-m-d_H-i-s_") . $DATABASE . '.sql.gz';

        shell_exec("mysqldump -h $HOST -P $PORT -u $USERNAME -p $DATABASE | gzip > $BACKUP_PATH");
        $output->writeln("<info>backup filename: $BACKUP_PATH</info>");

        return Command::SUCCESS;
    }
}