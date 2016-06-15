<?php
namespace Webshop\Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Twig_Environment;
use Webshop\Model\Repository\AbstractRepository;

abstract class AbstractController implements ControllerProviderInterface
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var array
     */
    private $repositories;

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
        $this->repositories = $app['repositories'];

        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];
        return $this->defineRoutes($controllers);
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

    /**
     * @param ControllerCollection $controllers
     */
    abstract protected function defineRoutes(ControllerCollection $controllers);
}