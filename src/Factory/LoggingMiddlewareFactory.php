<?php
namespace Riskio\SimpleBusModule\Factory;

use Psr\Log\LogLevel;
use SimpleBus\Message\Logging\LoggingMiddleware;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoggingMiddlewareFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return LoggingMiddlewareFactory
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $logger = $serviceLocator->get('logger');

        return new LoggingMiddleware($logger, LogLevel::INFO);
    }
}
