<?php

use Admin\Controller\AdminController;
use Silex\Application;
use Webshop\Controller\AccountController;
use Webshop\Controller\AuthController;
use Webshop\Controller\CartController;
use Webshop\Controller\MainController;

$app = require_once __DIR__.'/../app/app.php';

if (!$app instanceof Application) {
    throw new RuntimeException('Failed to initialize application.');
}

$app->mount('/admin', new AdminController());

$app->mount('/', new MainController());
$app->mount('/account', new AccountController());
$app->mount('/auth', new AuthController());
$app->mount('/cart', new CartController());

$app->run();
