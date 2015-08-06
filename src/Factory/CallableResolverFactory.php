<?php
namespace Riskio\SimpleBusModule\Factory;

use SimpleBus\Message\CallableResolver\CallableResolver;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CallableResolverFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return CallableResolver
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ServiceLocatorAwareCallableResolver(function ($serviceId) use ($serviceLocator) {
            $handler = $serviceLocator->get($serviceId);

            return [$handler, 'handle'];
        });
    }
}
