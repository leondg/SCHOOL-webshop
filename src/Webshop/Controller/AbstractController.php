<?php

namespace Webshop\Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Environment;
use Webshop\Model\Repository\AbstractRepository;

abstract class AbstractController implements ControllerProviderInterface
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var array
     */
    private $repositories;

    /**
     */
    abstract protected function init();

    /**
     * @param ControllerCollection $controllers
     */
    abstract protected function routes(ControllerCollection $controllers);

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $this->twig = $app['twig'];
        $this->session = $app['session'];
        $this->repositories = $app['repositories'];
        $this->init();

        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        return $this->routes($controllers);
    }

    /**
     * @param $repository
     *
     * @return AbstractRepository
     */
    public function getRepository($repository)
    {
        return $this->repositories[$repository];
    }
}
