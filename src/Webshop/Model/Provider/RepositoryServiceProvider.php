<?php
namespace Webshop\Model\Provider;

use Doctrine\DBAL\Connection;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RepositoryServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $app A container instance
     */
    public function register(Container $app)
    {
        /** @var Connection $connection */
        $connection = $app['db'];

        $app['repository'] = function($app) use ($connection) {
            $classes = $app['repository.classes'];

            $repository = [];
            foreach ($classes as $name => $class) {
                if (!class_exists($class)) {
                    continue;
                }

                $repository[$name] = new $class($connection);
            }

            return $repository;
        };
    }
}