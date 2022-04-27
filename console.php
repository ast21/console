#! /usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

# Laravel
$application->add(new App\Command\Laravel\KeyGenerateCommand());
$application->add(new App\Command\Laravel\PasswordGenerateCommand());

# Mysql
$application->add(new App\Command\Mysql\BackupCommand());
$application->add(new App\Command\Mysql\RestoreCommand());

# Other commands
$application->add(new App\Command\Random());

$application->run();
