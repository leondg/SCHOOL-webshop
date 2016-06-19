<?php
namespace Webshop\Controller;

use Silex\ControllerCollection;
use Webshop\Model\Service\Cart;

class CartController extends AbstractController
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     */
    protected function init()
    {
        $this->cart = new Cart($this->session);
    }

    /**
     * @param ControllerCollection $controllers
     *
     * @return ControllerCollection
     */
    protected function routes(ControllerCollection $controllers)
    {
        $controllers->get('/', [$this, 'index'])->bind('cart-index');
        $controllers->get('/add/{id}', [$this, 'add'])->bind('cart-add');

        return $controllers;
    }

    public function index()
    {
        return print_r($this->cart->getItems(), true);
    }

    public function add($id)
    {
        $this->cart->addItem($id, 1);

        return 'cart-add';
    }
}