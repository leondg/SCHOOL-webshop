<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class AccountController extends AbstractController
{
    /**
     */
    protected function init()
    {
        // TODO: Implement init() method.
    }

    /**
     * @param ControllerCollection $controllers
     *
     * @return ControllerCollection
     */
    protected function routes(ControllerCollection $controllers)
    {
        $controllers->get('/', [$this, 'index'])->bind('account-index');
        $controllers->get('/login', [$this, 'login'])->bind('account-login');
        $controllers->get('/register', [$this, 'register'])->bind('account-register');
        $controllers->get('/details', [$this, 'details'])->bind('account-details');
        $controllers->get('/address', [$this,  'address'])->bind('account-address');
        $controllers->get('/orders', [$this, 'orders'])->bind('account-orders');
        $controllers->get('/wishlist', [$this, 'wishList'])->bind('account-wishlist');

        return $controllers;
    }

    public function index()
    {
        var_dump($this->getUserToken()->isAuthenticated());

        return $this->render('account/index.twig');
    }

    public function details()
    {
    }

    public function register()
    {
        $encoder = new BCryptPasswordEncoder(13);
        var_dump($encoder->encodePassword('abc', ''));
    }
}
