<?php
use Riskio\SimpleBusModule\Factory;

return [
    'service_manager' => [
        'invokables' => [
            'simple_bus.command_bus.finishes_command_before_handling_next_middleware' => 'SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext',

            'simple_bus.command_bus.class_based_command_name_resolver' => 'SimpleBus\Message\Name\ClassBasedNameResolver',
            'simple_bus.command_bus.named_message_command_name_resolver' => 'SimpleBus\Message\Name\NamedMessageNameResolver',
        ],
        'factories' => [
            'simple_bus.command_bus' => Factory\CommandBusFactory::class,
            'simple_bus.command_bus.config' => Factory\CommandBusConfigFactory::class,
            'simple_bus.command_bus.callable_resolver' => Factory\CallableResolverFactory::class,
            'simple_bus.command_bus.command_handler_map' => Factory\CommandHandlerMapFactory::class,
            'simple_bus.command_bus.command_handler_resolver' => Factory\CommandHandlerResolverFactory::class,
            'simple_bus.command_bus.delegates_to_message_handler_middleware' => Factory\DelegatesToMessageHandlerMiddlewareFactory::class,
            'simple_bus.command_bus.logging_middleware' => Factory\LoggingMiddlewareFactory::class,

            'simple_bus.command_bus.doctrine.wraps_message_handling_in_transaction_middleware' => Factory\DoctrineWrapsMessageHandlingInTransactionFactory::class,
        ],
        'aliases' => [
            'command_bus' => 'simple_bus.command_bus',
        ],
    ],

    'command_bus' => [
        'command_name_resolver_strategy' => null,
        'middlewares' => [],
        'command_map' => [],
    ],
];
