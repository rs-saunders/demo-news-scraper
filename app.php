<?php
use Demo\Console\Command\ScrapeCommand;
use Symfony\Component\Console\Application;

include(__DIR__ .'/vendor/autoload.php');

$application = new Application();
$application->add(new ScrapeCommand());
$application->run();