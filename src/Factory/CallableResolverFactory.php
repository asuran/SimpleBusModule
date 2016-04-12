<?php
namespace Riskio\SimpleBusModule\Factory;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\CallableResolver\CallableResolver;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;

class CallableResolverFactory
{
    public function __invoke(ContainerInterface $container) : CallableResolver
    {
        return new ServiceLocatorAwareCallableResolver(function ($serviceId) use ($container) {
            $handler = $container->get($serviceId);

            return [$handler, 'handle'];
        });
    }
}
