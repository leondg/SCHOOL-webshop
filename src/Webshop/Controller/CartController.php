<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Webshop\Exception\ProductNotEnabled;
use Webshop\Exception\ProductNotFound;
use Webshop\Model\Entity\Product;
use Webshop\Model\Repository\ProductRepository;
use Webshop\Model\Service\CartService;

class CartController extends AbstractController
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * @var ProductRepository
     */
    private $product;

    /**
     */
    protected function init()
    {
        $this->cartService = new CartService($this->session);
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
        $controllers->post('/set', [$this, 'set'])->bind('cart-set');

        return $controllers;
    }

    public function index()
    {
        $cartItems = [];
        $totalPrice = 0;
        foreach ($this->cartService->getItems() as $key => $value) {
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

        $this->cartService->addItem($id, 1);

        return $this->redirect('/cart');
    }

    public function set(Request $request)
    {
        $id = $request->get('cart-item-id');
        $amount = $request->get('cart-item-amount');
        
        /** @var Product $product */
        if (!$product = $this->product->find($id)) {
            throw new ProductNotFound('The product you are trying to add does not exist.');
        }

        if ($product->getStatus() !== Product::STATUS_ENABLED) {
            throw new ProductNotEnabled('The product you are trying to add is not enabled.');
        }

        if ($amount < 1) {
            $this->remove($id);

            return $this->redirect('/cart');
        }

        $this->cartService->setItem($id, $amount);

        return $this->redirect('/cart');
    }

    public function remove($id)
    {
        $this->cartService->removeItem($id);

        return $this->redirect('/cart');
    }
}
