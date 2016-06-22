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
        $controllers->get('/login', [$this, 'login'])->bind('account-login');
        $controllers->get('/register', [$this, 'register'])->bind('account-register');

        return $controllers;
    }

    public function index()
    {

    }

    public function details()
    {
        
    }

    public function login()
    {

    }

    public function register()
    {
        $encoder = new BCryptPasswordEncoder(13);
        var_dump($encoder->encodePassword('abc', ''));
    }
}