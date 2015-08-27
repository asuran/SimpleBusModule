<?php
namespace Riskio\SimpleBusModule\Factory;

use Riskio\SimpleBusModule\Middleware\WrapsMessageHandlingInTransaction;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WrapsMessageHandlingInTransactionFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return WrapsMessageHandlingInTransaction
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        return new WrapsMessageHandlingInTransaction($entityManager);
    }
}
