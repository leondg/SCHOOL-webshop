<?php

namespace Webshop\Controller;

use Silex\ControllerCollection;
use Webshop\Model\Repository\AccountRepository;
use Webshop\Model\Repository\ProductRepository;

class MainController extends AbstractController
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
     */
    protected function init()
    {
        $this->account = $this->getRepository('account');
        $this->products = $this->getRepository('product');
    }

    /**
     * @param ControllerCollection $controllers
     *
     * @return ControllerCollection
     */
    protected function routes(ControllerCollection $controllers)
    {
        $controllers->get('/', [$this, 'index'])->bind('index');
        $controllers->get('/desktops', [$this, 'desktops'])->bind('desktops');
        $controllers->get('/laptops', [$this, 'laptops'])->bind('laptops');
        $controllers->get('/tablets', [$this, 'tablets'])->bind('tablets');
        $controllers->get('/components', [$this, 'components'])->bind('components');
        $controllers->get('/components/{category}', [$this, 'componentsCategory'])->bind('componentsCategory');

        return $controllers;
    }

    /**
     * @return string
     */
    public function index()
    {
        $context['products'] = $this->products->findAll();

        return $this->twig->render('main/index.twig', $context);
    }

    /**
     * @return string
     */
    public function desktops()
    {
        $context['products'] = $this->products->findByCategory('desktop');

        return $this->twig->render('main/desktops.twig', $context);
    }

    public function components()
    {
        return $this->twig->render('main/components.twig');
    }

    public function componentsCategory($category)
    {
        $context['products'] = $this->products->findByCategory($category);

        return $this->twig->render('main/components-category.twig', $context);
    }
}
