<?php
namespace Riskio\SimpleBusModule\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class DoctrineWrapsMessageHandlingInTransaction implements MessageBusMiddleware
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle($message, callable $next)
    {
        $this->entityManager->transactional(
            function () use ($message, $next) {
                $next($message);
            }
        );
    }
}
