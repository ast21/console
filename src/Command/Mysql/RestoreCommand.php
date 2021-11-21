<?php

namespace App\Command\Mysql;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class RestoreCommand extends Command
{
    protected static $defaultName = 'mysql:restore';

    protected function configure(): void
    {
        $this
            ->addArgument('path', InputArgument::REQUIRED, 'Enter the backup path')
            ->addArgument('database', InputArgument::REQUIRED, 'Enter the database')
            ->addArgument('username', InputArgument::OPTIONAL, 'Enter the username')
            ->addArgument('host', InputArgument::OPTIONAL, 'Enter the host')
            ->addArgument('port', InputArgument::OPTIONAL, 'Enter the port')
            ->setDescription('Mysql dump database in this folder');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $HOST = $input->getArgument('username') ?? '127.0.0.1';
        $PORT = $input->getArgument('username') ?? '3306';
        $USERNAME = $input->getArgument('username') ?? 'root';
        $DATABASE = $input->getArgument('database');
        $BACKUP_PATH = $input->getArgument('path') ?? date("Y-m-d_H-i-s_") . $DATABASE . '.sql.gz';

        # Кавычки mysql + экранирование кавычек для shell
        $SQL_DB = "\`$DATABASE\`";

        # Drop database
        shell_exec("mysql -h $HOST -P $PORT -u $USERNAME -p -e \"DROP DATABASE IF EXISTS $SQL_DB; CREATE DATABASE $SQL_DB;\"");

        # Restore database
        shell_exec("gunzip -c $BACKUP_PATH | mysql -h $HOST -P $PORT -u $USERNAME -p $DATABASE");

        $output->writeln("<info>Database RESTORE successfully completed</info>");

        return Command::SUCCESS;
    }
}