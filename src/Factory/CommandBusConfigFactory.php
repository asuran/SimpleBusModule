<?php
namespace Riskio\SimpleBusModule\Factory;

use Interop\Container\ContainerInterface;

class CommandBusConfigFactory
{
    public function __invoke(ContainerInterface $container) : array
    {
        return $container->get('Config')['command_bus'];
    }
}
