<?php

namespace Admin\Controller;

use Silex\ControllerCollection;
use Webshop\Controller\AbstractController;

class AdminController extends AbstractController
{
    private $accounts;
    private $accountAdresses;
    private $products;
    private $searchHistory;
    private $orders;
    /**
     */
    protected function init()
    {
        $this->accounts = $this->getRepository('account');
        $this->accountAdresses = $this->getRepository('account_address');
        $this->products = $this->getRepository('product');
        $this->searchHistory = $this->getRepository('search_history');
        $this->orders = $this->getRepository('order');
    }

    /**
     * @param ControllerCollection $controllers
     *
     * @return ControllerCollection
     */
    protected function routes(ControllerCollection $controllers)
    {
        $controllers->get('/', [$this, 'index'])->bind('admin.index');
        $controllers->get('/accounts', [$this, 'accounts'])->bind('admin.accounts');
        $controllers->get('/accounts/{account}', [$this, 'accountEdit'])->bind('admin.accounts.edit');
        $controllers->get('/accounts/create', [$this, 'accountCreate'])->bind('admin.accounts.create');
        $controllers->get('/products', [$this, 'products'])->bind('admin.products');
        $controllers->get('/products/{product}', [$this, 'productEdit'])->bind('admin.products.edit');
        $controllers->get('/searchhistory', [$this, 'searchhistory'])->bind('admin.searchhistory');
        $controllers->get('/orders', [$this, 'orders'])->bind('admin.orders');
        $controllers->get('/orders/{order}', [$this, 'orderEdit'])->bind('admin.orders.edit');

        return $controllers;
    }

    public function index()
    {
        // TODO Wat wil je hier?

        return $this->twig->render('admin/index.twig');
    }

    public function accounts()
    {
        $context['accounts'] = $this->accounts->findAll();

        return $this->twig->render('admin/accounts.twig', $context);
    }

    public function accountEdit($account)
    {
        $context['accounts'] = $this->accounts->find($account);
        $context['account_address'] = $this->accountAdresses->findByAccount($account);

        return $this->twig->render('admin/accountEdit.twig', $context);
    }

    public function accountCreate()
    {
        return $this->twig->render('admin/accountCreate.twig');
    }

    public function products()
    {
        $context['products'] = $this->products->findAll();

        return $this->twig->render('admin/products.twig', $context);
    }

    public function productEdit($product)
    {
        $context['products'] = $this->products->find($product);

        return $this->twig->render('admin/productEdit.twig', $context);
    }

    public function searchhistory()
    {
        $context['searchhistory'] = $this->searchhistory->findAll();

        return $this->twig->render('admin/searchhistory.twig', $context);
    }

    public function orders()
    {
        $context['orders'] = $this->orders->findAll();

        return $this->twig->render('admin/orders.twig', $context);
    }

    public function orderEdit($order)
    {
        $context['orders'] = $this->orders->find($order);

        return $this->twig->render('admin/orderEdit.twig', $context);
    }
}
