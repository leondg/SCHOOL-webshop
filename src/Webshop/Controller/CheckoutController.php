<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Webshop\Model\Repository\AccountRepository;
use Webshop\Model\Repository\ProductRepository;

class CheckoutController extends AbstractController
{
    /**
     * @var AccountRepository
     */
    private $account;

    /**
     * @var ProductRepository
     */
    private $products;

    /**
     */
    protected function init()
    {
        $this->account = $this->getRepository('account');
        $this->products = $this->getRepository('product');
    }

    /**
     * @param ControllerCollection $controllers
     *
     * @return ControllerCollection
     */
    protected function routes(ControllerCollection $controllers)
    {
        $controllers->get('/', [$this, 'index'])->bind('checkout-index');
        $controllers->get('/login', [$this, 'login'])->bind('checkout-login');

        return $controllers;
    }

    public function index()
    {
        return $this->redirect('/checkout/login');
    }

    public function login()
    {
        return $this->render('checkout/login.twig');
    }

    public function register()
    {
        return $this->redirect('/account/register/return/checkout');
    }
}
