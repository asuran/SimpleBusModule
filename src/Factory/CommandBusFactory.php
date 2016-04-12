<?php
namespace Riskio\SimpleBusModule\Factory;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SplPriorityQueue;

class CommandBusFactory
{
    public function __invoke(ContainerInterface $container) : MessageBus
    {
        $commandBus = new MessageBusSupportingMiddleware();

        $commandBusConfig = $container->get('simple_bus.command_bus.config');
        $middlewares = $this->createMiddlewarePriorityQueue($commandBusConfig['middlewares']);
        $orderedMiddlewares = iterator_to_array($middlewares, false);

        foreach ($orderedMiddlewares as $middleware) {
            $commandBus->appendMiddleware($container->get($middleware));
        }

        return $commandBus;
    }

    private function createMiddlewarePriorityQueue(array $middlewares) : SplPriorityQueue
    {
        $priorityQueue = new SplPriorityQueue();
        foreach ($middlewares as $key => $value) {
            if (is_string($key) && is_array($value)) {
                $middleware = $key;
                $priority   = isset($value['priority']) ? $value['priority'] : 0;
            } else {
                $middleware = $value;
                $priority   = 0;
            }

            $priorityQueue->insert($middleware, $priority);
        }

        return $priorityQueue;
    }
}
