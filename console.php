#! /usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new App\Command\Laravel\KeyGenerateCommand());
$application->add(new App\Command\Laravel\PasswordGenerateCommand());

$application->add(new App\Command\Random());
$application->add(new App\Command\Generate\PDFGenerateCommand());

$application->run();
