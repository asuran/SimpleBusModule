<?php
namespace Riskio\SimpleBusModule\Factory;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Riskio\SimpleBusModule\Middleware\DoctrineWrapsMessageHandlingInTransaction;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class DoctrineWrapsMessageHandlingInTransactionFactory
{
    public function __invoke(ContainerInterface $container) : MessageBusMiddleware
    {
        $entityManager = $container->get(EntityManager::class);

        return new DoctrineWrapsMessageHandlingInTransaction($entityManager);
    }
}
