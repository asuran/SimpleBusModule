<?php
namespace Riskio\SimpleBusModule\Factory;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Handler\Resolver\MessageHandlerResolver;

class CommandHandlerResolverFactory
{
    public function __invoke(ContainerInterface $container) : MessageHandlerResolver
    {
        $commandBusConfig = $container->get('simple_bus.command_bus.config');
        $commandNameResolverStrategy = $commandBusConfig['command_name_resolver_strategy'];

        $commandNameResolver = $container->get($commandNameResolverStrategy);
        $commandHandlerMap   = $container->get('simple_bus.command_bus.command_handler_map');

        return new NameBasedMessageHandlerResolver($commandNameResolver, $commandHandlerMap);
    }
}
