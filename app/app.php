<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SecurityServiceProvider;
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
use Webshop\Model\Service\UserService;
use Webshop\Resources\Extension\TwigExtension;

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
        'host' => 'localhost',
        'dbname' => 'webshop',
        'user' => 'admin',
        'password' => 'admin',
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

$app->register(new SecurityServiceProvider(), [
    'security.firewalls' => [
        'default' => [
            'pattern' => '^/.*$',
            'anonymous' => true,
            'form' => ['login_path' => '/auth/login', 'check_path' => '/auth/login-check'],
            'logout' => ['logout_path' => '/auth/logout', 'invalidate_session' => true],
            'users' => function ($app) use ($app) {
                return new UserService($app);
            },
        ]
    ]
]);

$app['security.access_rules'] = [
    ['^/account/', 'ROLE_USER'],
    ['^/checkout/', 'ROLE_USER'],
];

// Security requires a boot
$app->boot();

$app->register(new TwigServiceProvider(), [
    'twig.path' => [
        __DIR__.'/../src/Webshop/Resources/views',
        __DIR__.'/../src/Admin/Resources/views',
    ],
]);

$app['twig'] = $app->extend('twig', function (Twig_Environment $twig, $app) {
    $twig->addExtension(new TwigExtension($app));

    return $twig;
});

return $app;
