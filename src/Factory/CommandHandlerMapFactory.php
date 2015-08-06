<?php
namespace Riskio\SimpleBusModule\Factory;

use SimpleBus\Message\CallableResolver\CallableMap;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommandHandlerMapFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return CallableMap
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $commandBusConfig = $serviceLocator->get('simple_bus.command_bus.config');
        $callableResolver = $serviceLocator->get('simple_bus.command_bus.callable_resolver');

        return new CallableMap($commandBusConfig['command_map'], $callableResolver);
    }
}
