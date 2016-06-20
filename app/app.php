<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Webshop\Model\Provider\RepositoryServiceProvider;
use Webshop\Model\Repository\AccountAddressRepository;
use Webshop\Model\Repository\AccountRepository;
use Webshop\Model\Repository\DiscountCodeRepository;
use Webshop\Model\Repository\OrderLineRepository;
use Webshop\Model\Repository\OrderRepository;
use Webshop\Model\Repository\PaymentMethodRepository;
use Webshop\Model\Repository\ProductRepository;
use Webshop\Model\Repository\SearchHistoryRepository;
use Webshop\Model\Repository\WishListLineRepository;
use Webshop\Model\Repository\WishListRepository;

require __DIR__.'/../vendor/autoload.php';

$app = new Application();
$app['debug'] = true;

$app->register(new SessionServiceProvider());

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__.'/../app/logs/application.log',
]);

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_mysql',
        'host' => '10.0.0.3',
        'dbname' => 'leon_avans_webshop',
        'user' => 'leon',
        'password' => 'halloWereld',
    ],
]);

$app->register(new RepositoryServiceProvider(), [
    'repository.classes' => [
        'account' => AccountRepository::class,
        'account_address' => AccountAddressRepository::class,
        'discount_code' => DiscountCodeRepository::class,
        'order' => OrderRepository::class,
        'order_line' => OrderLineRepository::class,
        'payment_method' => PaymentMethodRepository::class,
        'product' => ProductRepository::class,
        'search_history' => SearchHistoryRepository::class,
        'wish_list' => WishListRepository::class,
        'wish_list_line' => WishListLineRepository::class,
    ],
]);

$app->register(new ServiceControllerServiceProvider());

$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../src/Webshop/Resources/views',
]);

return $app;
