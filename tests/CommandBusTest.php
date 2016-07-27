<?php
namespace Riskio\SimpleBusModuleTest;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use Zend\ServiceManager\ServiceManager;

class CommandBusTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCommandBusFromServiceManagerShouldReturnMessageBusInstanceWithMiddlewares()
    {
        $config = include __DIR__ . '/../config/module.config.php';
        $serviceManager = new ServiceManager($config['service_manager']);
        $serviceManager->setService('Config', $config);

        $logger = $this->createMock(LoggerInterface::class);
        $serviceManager->setService('logger', $logger);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $serviceManager->setService(EntityManager::class, $entityManager);

        /* @var $commandBus MessageBusSupportingMiddleware */
        $commandBus = $serviceManager->get('command_bus');

        $this->assertInstanceOf(MessageBus::class, $commandBus);

        $this->assertCount(
            count($config['command_bus']['middlewares']),
            $commandBus->getMiddlewares()
        );
    }
}
