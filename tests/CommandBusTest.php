<?php
namespace Riskio\SimpleBusModuleTest;

use Psr\Log\LoggerInterface;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Config;

class CommandBusTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCommandBusFromServiceManagerShouldReturnMessageBusInstanceWithMiddlewares()
    {
        $config = include __DIR__ . '/../config/module.config.php';
        $serviceManager = new ServiceManager(new Config($config['service_manager']));
        $serviceManager->setService('Config', $config);

        $logger = $this->getMock(LoggerInterface::class);
        $serviceManager->setService('logger', $logger);

        /* @var $commandBus MessageBusSupportingMiddleware */
        $commandBus = $serviceManager->get('command_bus');

        $this->assertInstanceOf(MessageBus::class, $commandBus);

        $this->assertCount(
            count($config['command_bus']['middlewares']),
            $commandBus->getMiddlewares()
        );
    }
}
