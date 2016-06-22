<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Webshop\Model\Repository\AccountRepository;
use Webshop\Model\Repository\ProductRepository;
use Webshop\Model\Service\CartService;
use Webshop\Model\Service\OrderService;

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
     * @var CartService
     */
    private $cartService;

    /**
     * @var OrderService
     */
    private $orderService;

    /**
     */
    protected function init()
    {
        $this->account = $this->getRepository('account');
        $this->products = $this->getRepository('product');
        $this->cartService = new CartService($this->session);
        $this->orderService = new OrderService(
            $this->getRepository('order'),
            $this->getRepository('order_line'),
            $this->products
        );
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
        $controllers->get('/create', [$this, 'create'])->bind('checkout-create');

        return $controllers;
    }

    public function index()
    {
        return $this->redirect('/checkout/login');
    }

    public function login()
    {
        return $this->redirect('/checkout/create');
    }

    public function register()
    {
        return $this->redirect('/account/register/return/checkout');
    }

    public function create()
    {
        $cart = $this->cartService->getItems();

        $orderId = $this->orderService->createFromCart($cart, 1, 3, 'default');

        var_dump($this->orderService->getOrderData($orderId));
        exit;
    }
}
