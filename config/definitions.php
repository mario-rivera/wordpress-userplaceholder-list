<?php
use Psr\Container\ContainerInterface;
use Nyholm\Psr7\Factory\Psr17Factory;

return [
    'assets.config' => [
        'url' => plugin_dir_url(dirname(__FILE__)) . 'assets',
        'dir' => dirname(__DIR__) . '/assets'
    ],
    /**
     * Response
     */
    \Psr\Http\Message\ResponseInterface::class => function (Psr17Factory $factory) {
        return $factory->createResponse(200);
    },
    /**
     * Users
     */
    'users.api.conf' => [
        'base_url' => 'https://jsonplaceholder.typicode.com/'
    ],
    \InpsydeTest\User\UserClient::class => 
        \DI\factory([\InpsydeTest\User\UserClientFactory::class, 'create'])
        ->parameter('options', \DI\get('users.api.conf'))
];