<?php
namespace Riskio\SimpleBusModule\Factory;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;

class DelegatesToMessageHandlerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : MessageBusMiddleware
    {
        $commandHandlerResolver = $container->get('simple_bus.command_bus.command_handler_resolver');

        return new DelegatesToMessageHandlerMiddleware(
            $commandHandlerResolver
        );
    }
}
