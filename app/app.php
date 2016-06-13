<?php
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Webshop\Model\Provider\RepositoryServiceProvider;
use Webshop\Model\Repository\PaymentMethodRepository;
use Webshop\Model\Repository\ProductRepository;

require __DIR__.'/../vendor/autoload.php';

$app = new Application();
$app['debug'] = true;

$app->register(new SessionServiceProvider());

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__.'/../app/logs/application.log',
]);

$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../src/Webshop/Resources/views',
]);

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'webshop',
        'user'      => 'webshop',
        'password'  => 'avans',
    ],
]);

$app->register(new RepositoryServiceProvider(), [
    'repository.classes' => [
        'product' => ProductRepository::class,
        'payment_method' => PaymentMethodRepository::class,
    ],
]);

return $app;