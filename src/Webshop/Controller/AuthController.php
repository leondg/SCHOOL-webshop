<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends AbstractController
{
    protected function init()
    {
    }

    /**
     * @param ControllerCollection $controllers
     *
     * @return ControllerCollection
     */
    protected function routes(ControllerCollection $controllers)
    {
        $controllers->get('/login', [$this, 'login'])->bind('auth-login');
        $controllers->get('/login-check')->bind('auth-login-check');
        $controllers->get('/logout', [$this, 'logout'])->bind('auth-logout');

        return $controllers;
    }

    public function login(Request $request)
    {
        $context = [
            'error' => $this->getLastError($request),
            'last_username' => $this->session->get('_security.last_username'),
        ];

        return $this->render('auth/login.twig', $context);
    }
}
