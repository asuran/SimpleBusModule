<?php
namespace Riskio\SimpleBusModule\Factory;

use Riskio\SimpleBusModule\Middleware\DoctrineWrapsMessageHandlingInTransaction;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineWrapsMessageHandlingInTransactionFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return DoctrineWrapsMessageHandlingInTransaction
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        return new DoctrineWrapsMessageHandlingInTransaction($entityManager);
    }
}
