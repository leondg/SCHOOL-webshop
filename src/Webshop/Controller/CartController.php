<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Webshop\Model\Repository\ProductRepository;
use Webshop\Model\Service\Cart;

class CartController extends AbstractController
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var ProductRepository
     */
    private $product;

    /**
     */
    protected function init()
    {
        $this->cart = new Cart($this->session);
        $this->product = $this->getRepository('product');
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
        $products = [];
        foreach ($this->cart->getItems() as $key => $value) {
            $products[] = $this->product->find($key);
        }

        return $this->twig->render('cart/index.twig', ['products' => $products]);
    }

    public function add($id)
    {
        if (!$this->product->exists($id)) {
            throw new InvalidParameterException('The product you are trying to add doesnt exist.');
        }

        $this->cart->addItem($id, 1);

        return 'cart-add';
    }
}
