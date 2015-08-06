<?php
namespace Riskio\SimpleBusModule\Factory;

use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommandHandlerResolverFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return NameBasedMessageHandlerResolver
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $commandBusConfig = $serviceLocator->get('simple_bus.command_bus.config');
        $commandNameResolverStrategy = $commandBusConfig['command_name_resolver_strategy'];

        $commandNameResolver = $serviceLocator->get($commandNameResolverStrategy);
        $commandHandlerMap   = $serviceLocator->get('simple_bus.command_bus.command_handler_map');

        return new NameBasedMessageHandlerResolver($commandNameResolver, $commandHandlerMap);
    }
}
