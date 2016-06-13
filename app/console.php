#!/usr/bin/env php
<?php

use Doctrine\DBAL\Tools\Console\ConsoleRunner;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Helper\HelperSet;
use Webshop\Command\DatabaseCreateCommand;

date_default_timezone_set('UTC');

set_time_limit(0);

require_once __DIR__.'/app.php';

$console = new ConsoleApplication('Avans Webshop CLI', '0.1.0');

$console->add(new DatabaseCreateCommand($app));

$helperSet = new HelperSet([
    'db' => new ConnectionHelper($app['db']),
]);

// Adds dbal commands
ConsoleRunner::addCommands($console);

$console->setHelperSet($helperSet);
$console->run();