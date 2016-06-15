<?php
use Silex\Application;
use Webshop\Controller\CartController;
use Webshop\Controller\MainController;
use Webshop\Model\Repository\PaymentMethodRepository;
use Webshop\Model\Repository\ProductRepository;

$app = require_once __DIR__.'/../app/app.php';

if (!$app instanceof Application) {
    throw new RuntimeException('Failed to initialize application.');
}

$app->mount('/', new MainController());

$app->get('/', function() use($app) {
    /** @var ProductRepository $productRepository */
    $productRepository = $app['repository']['product'];

    return $app['twig']->render('main/index.twig', ['products' => $productRepository->findAll()]);
});

$app->get('/payment', function() use($app) {
    /** @var PaymentMethodRepository $paymentMethodRepository */
    $paymentMethodRepository = $app['repository']['payment_method'];

    return $app['twig']->render('main/payment.twig', ['payments' => $paymentMethodRepository->findAll()]);
});

$app->run();