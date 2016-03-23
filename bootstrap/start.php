<?php

use Styde\Container;
use Styde\SessionArrayDriver;
use Styde\SessionManager;
use Styde\Authenticator;
use Styde\AccessHandler;
use Styde\AuthenticatorInterface;

require __DIR__ .'/../vendor/autoload.php';

class_alias('Styde\Facades\Access', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$container = Container::getInstance();

$container->singleton('session', function () {
    $data = [
        'user_data' => [
            'name' => 'Duilio',
            'role' => 'teacher'
        ]
    ];

    $driver = new SessionArrayDriver($data);
    return new SessionManager($driver);
});

$container->singleton(AuthenticatorInterface::class, function ($app) {
    return new Authenticator($app->make('session'));
});

$container->singleton('access', function ($app) {
    // return new AccessHandler($app->make('auth'));
    return $app->build(Styde\AccessHandler::class);
});
