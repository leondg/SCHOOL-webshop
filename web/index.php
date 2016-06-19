<?php

use Silex\Application;
use Webshop\Controller\MainController;

$app = require_once __DIR__.'/../app/app.php';

if (!$app instanceof Application) {
    throw new RuntimeException('Failed to initialize application.');
}

$app->mount('/', new MainController());

$app->run();
