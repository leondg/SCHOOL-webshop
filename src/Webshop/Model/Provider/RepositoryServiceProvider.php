<?php

namespace Webshop\Model\Provider;

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
        $connection = $app['db'];

        $app['repositories'] = function ($app) use ($connection) {
            $classes = $app['repository.classes'];

            $repositories = [];
            foreach ($classes as $name => $class) {
                if (!class_exists($class)) {
                    continue;
                }

                $repositories[$name] = new $class($connection);
            }

            return $repositories;
        };
    }
}
