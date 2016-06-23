<?php

namespace Webshop\Model\Service;

use Symfony\Component\HttpFoundation\Session\Session;

class CartService
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var array
     */
    private $cartItems;

    public function __construct(Session $session)
    {
        if (!$session->has('cart')) {
            $session->set('cart', []);
        }

        $this->cartItems = $session->get('cart');

        $this->session = $session;
    }

    public function addItem($id, $amount = 1)
    {
        if (isset($this->cartItems[$id])) {
            $itemAmount = $this->cartItems[$id];
            $amount += $itemAmount;
        }

        if ($amount <= 0) {
            $this->removeItem($id);
        }

        $this->cartItems[$id] = $amount;

        $this->session->set('cart', $this->cartItems);
    }

    public function setItem($id, $amount)
    {
        if ($amount === 0) {
            return;
        }

        if (isset($this->cartItems[$id])) {
            $this->cartItems[$id] = $amount;
        }

        $this->session->set('cart', $this->cartItems);
    }

    public function removeItem($id)
    {
        unset($this->cartItems[$id]);

        $this->session->set('cart', $this->cartItems);
    }

    public function getItems()
    {
        return $this->cartItems;
    }

    public function clearItems()
    {
        $this->cartItems = [];

        $this->session->set('cart', $this->cartItems);
    }
}
