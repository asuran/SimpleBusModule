<?php
namespace Riskio\SimpleBusModule\Factory;

use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DelegatesToMessageHandlerMiddlewareFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return DelegatesToMessageHandlerMiddleware
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $commandHandlerResolver = $serviceLocator->get('simple_bus.command_bus.command_handler_resolver');

        return new DelegatesToMessageHandlerMiddleware(
            $commandHandlerResolver
        );
    }
}
