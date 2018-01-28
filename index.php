#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/vendor/autoload.php';


use Symfony\Component\Console\Application;
//---------------------------
use JCA\Commands\Laravel\InstallJlib;
use JCA\Commands\Laravel\LaravelInstaller;

$application = new Application();

$application->add(new LaravelInstaller());
$application->add(new InstallJlib());

$application->run();