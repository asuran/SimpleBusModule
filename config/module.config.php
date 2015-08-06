<?php
return [
    'service_manager' => [
        'invokables' => [
            'simple_bus.command_bus.finishes_command_before_handling_next_middleware' => 'SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext',

            'simple_bus.command_bus.class_based_command_name_resolver' => 'SimpleBus\Message\Name\ClassBasedNameResolver',
            'simple_bus.command_bus.named_message_command_name_resolver' => 'SimpleBus\Message\Name\NamedMessageNameResolver',
        ],
        'factories' => [
            'simple_bus.command_bus' => 'Riskio\SimpleBusModule\Factory\CommandBusFactory',
            'simple_bus.command_bus.config' => 'Riskio\SimpleBusModule\Factory\CommandBusConfigFactory',
            'simple_bus.command_bus.callable_resolver' => 'Riskio\SimpleBusModule\Factory\CallableResolverFactory',
            'simple_bus.command_bus.command_handler_map' => 'Riskio\SimpleBusModule\Factory\CommandHandlerMapFactory',
            'simple_bus.command_bus.command_handler_resolver' => 'Riskio\SimpleBusModule\Factory\CommandHandlerResolverFactory',
            'simple_bus.command_bus.delegates_to_message_handler_middleware' => 'Riskio\SimpleBusModule\Factory\DelegatesToMessageHandlerMiddlewareFactory',
            'simple_bus.command_bus.logging_middleware' => 'Riskio\SimpleBusModule\Factory\LoggingMiddlewareFactory',
        ],
        'alias' => [
            'command_bus' => 'simple_bus.command_bus',
        ],
    ],

    'command_bus' => [
        'command_name_resolver_strategy' => 'simple_bus.command_bus.class_based_command_name_resolver',
        'middlewares' => [
            'simple_bus.command_bus.finishes_command_before_handling_next_middleware' => ['priority' => 1000],
            'simple_bus.command_bus.logging_middleware',
            'simple_bus.command_bus.delegates_to_message_handler_middleware' => ['priority' => -1000],
        ],
        'command_map' => [],
        'handlers' => [],
    ],
];
