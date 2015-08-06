<?php
namespace Riskio\SimpleBusModule\Factory;

use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SplPriorityQueue;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommandBusFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return MessageBusSupportingMiddleware
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $commandBus = new MessageBusSupportingMiddleware();

        $commandBusConfig = $serviceLocator->get('simple_bus.command_bus.config');

        $middlewares = new SplPriorityQueue();
        foreach ($commandBusConfig['middlewares'] as $key => $value) {
            if (is_string($key) && is_array($value)) {
                $middleware = $key;
                $priority   = isset($value['priority']) ? $value['priority'] : 0;
            } else {
                $middleware = $value;
                $priority   = 0;
            }

            $middlewares->insert($middleware, $priority);
        }

        $orderedMiddlewares = iterator_to_array($middlewares, false);

        foreach ($orderedMiddlewares as $middleware) {
            $commandBus->appendMiddleware($serviceLocator->get($middleware));
        }

        return $commandBus;
    }
}
