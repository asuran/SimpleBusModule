<?php
namespace Riskio\SimpleBusModule\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class DoctrineWrapsMessageHandlingInTransaction implements MessageBusMiddleware
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param object $message
     * @param callable $next
     */
    public function handle($message, callable $next)
    {
        $this->entityManager->transactional(
            function () use ($message, $next) {
                $next($message);
            }
        );
    }
}
