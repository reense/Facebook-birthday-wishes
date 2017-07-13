#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Reense\ConsoleCommand\HelloCommand;
use Symfony\Component\Console\Application;


$application = new Application();
$application->add(new HelloCommand());
$application->run();

