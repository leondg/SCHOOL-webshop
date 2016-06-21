<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Webshop\Exception\ProductNotEnabled;
use Webshop\Exception\ProductNotFound;
use Webshop\Model\Entity\Product;
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
        $controllers->get('/remove/{id}', [$this, 'remove'])->bind('cart-remove');

        return $controllers;
    }

    public function index()
    {
        $cartItems = [];
        $totalPrice = 0;
        foreach ($this->cart->getItems() as $key => $value) {
            /** @var Product $product */
            $product = $this->product->find($key);
            $price = $product->getPrice() * $value;
            $cartItems[] = ['product' => $product, 'amount' => $value, 'price' => $price];
            $totalPrice += $price;
        }

        $context['cartItems'] = $cartItems;
        $context['totalPrice'] = $totalPrice;

        return $this->twig->render('cart/index.twig', $context);
    }

    public function add($id)
    {
        /** @var Product $product */
        if (!$product = $this->product->find($id)) {
            throw new ProductNotFound('The product you are trying to add does not exist.');
        }

        if ($product->getStatus() !== Product::STATUS_ENABLED) {
            throw new ProductNotEnabled('The product you are trying to add is not enabled.');
        }

        $this->cart->addItem($id, 1);

        return $this->redirect('/cart');
    }

    public function remove($id)
    {
        $this->cart->removeItem($id);

        return $this->redirect('/cart');
    }
}
