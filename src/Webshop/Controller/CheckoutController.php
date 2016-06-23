<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Webshop\Model\Entity\PaymentMethod;
use Webshop\Model\Repository\AccountRepository;
use Webshop\Model\Repository\OrderRepository;
use Webshop\Model\Repository\ProductRepository;
use Webshop\Model\Service\AccountService;
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
     * @var OrderRepository
     */
    private $order;

    /**
     * @var CartService
     */
    private $cartService;

    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * @var AccountService
     */
    private $accountService;

    /**
     */
    protected function init()
    {
        $this->account = $this->getRepository('account');
        $this->products = $this->getRepository('product');
        $this->order = $this->getRepository('order');
        $this->cartService = new CartService($this->session);
        $this->orderService = new OrderService(
            $this->order,
            $this->getRepository('order_line'),
            $this->products
        );
        $this->accountService = new AccountService(
            $this->getRepository('account'),
            $this->getRepository('account_address')
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
        $controllers->get('/overview/{orderId}', [$this, 'overview'])->bind('checkout-overview');
        $controllers->get('/payment/{orderId}/{paymentMethodId}', [$this, 'payment'])->bind('checkout-payment');
        $controllers->get('/complete/{orderId}', [$this, 'complete'])->bind('checkout-complete');

        return $controllers;
    }

    public function index()
    {
        return 'Nothing here.';
    }

    public function create()
    {
        $cart = $this->cartService->getItems();

        $orderId = $this->orderService->createFromCart($cart, 1, 3, 'default');

        $this->cartService->clearItems();

        return $this->redirect('/checkout/overview/'.$orderId);
    }

    public function overview($orderId)
    {
        $username = $this->getUserToken()->getUsername();

        $paymentMethods = [];
        $allPaymentMethods = $this->getRepository('payment_method')->findAll();
        /** @var PaymentMethod $paymentMethod */
        foreach ($allPaymentMethods as $paymentMethod) {
            if ($paymentMethod->getStatus() !== PaymentMethod::STATUS_ENABLED) {
                continue;
            }

            $paymentMethods[] = $paymentMethod;
        }

        $context['orderData'] = $this->orderService->getOrderData($orderId);
        $context['accountData'] = $this->accountService->getAccountDataByUsername($username);
        $context['paymentMethods'] = $paymentMethods;

        return $this->render('checkout/overview.twig', $context);
    }

    public function payment($orderId, $paymentMethodId)
    {
        $this->order->update(['payment_method_id' => $paymentMethodId], ['id' => $orderId]);

        return $this->redirect('/checkout/complete/'.$orderId);
    }

    public function complete($orderId)
    {
        $context['orderId'] = $orderId;

        return $this->render('checkout/complete.twig', $context);
    }
}
