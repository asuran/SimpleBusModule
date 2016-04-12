<?php
namespace Riskio\SimpleBusModule\Factory;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\CallableResolver\CallableMap;

class CommandHandlerMapFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $commandBusConfig = $container->get('simple_bus.command_bus.config');
        $callableResolver = $container->get('simple_bus.command_bus.callable_resolver');

        return new CallableMap(
            $commandBusConfig['command_map'],
            $callableResolver
        );
    }
}
