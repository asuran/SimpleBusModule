<?php
namespace Riskio\SimpleBusModule\Factory;

use Interop\Container\ContainerInterface;
use Psr\Log\LogLevel;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Logging\LoggingMiddleware;

class LoggingMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : MessageBusMiddleware
    {
        $logger = $container->get('logger');

        return new LoggingMiddleware($logger, LogLevel::INFO);
    }
}
