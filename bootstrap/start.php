<?php

use Styde\Application;
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

Access::setContainer($container);

$application = new Application($container);
$application->register();
