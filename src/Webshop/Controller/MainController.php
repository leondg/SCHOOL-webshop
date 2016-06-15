<?php
namespace Webshop\Controller;

use Silex\ControllerCollection;

class MainController extends AbstractController
{
    protected function defineRoutes(ControllerCollection $controllers)
    {
        $productRepo = $this->getRepository('product');

        $controllers->get('/', function () use ($productRepo) {
            return $this->twig->render('main/index.twig', ['products' => $productRepo->findAll()]);
        });

        $controllers->get('/cart', function () use ($productRepo) {
            return $this->twig->render('main/payment.twig', ['payments' => $productRepo->findAll()]);
        });

        return $controllers;
    }
}