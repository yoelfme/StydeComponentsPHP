<?php
namespace Styde;

class Application
{
    /**
     * @var Container
     */
    protected $container;


    /**
     * Application constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register()
    {
        $this->registerSessionManager();
        $this->registerAccessHandler();
        $this->registerAuthenticator();
    }

    protected function registerSessionManager()
    {
        $this->container->singleton('session', function () {
            $data = [
                'user_data' => [
                    'name' => 'Duilio',
                    'role' => 'teacher'
                ]
            ];

            $driver = new SessionArrayDriver($data);
            return new SessionManager($driver);
        });
    }

    protected function registerAuthenticator()
    {
        $this->container->singleton(AuthenticatorInterface::class, function ($app) {
            return new Authenticator($app->make('session'));
        });
    }

    protected function registerAccessHandler()
    {
        $this->container->singleton('access', function ($app) {
            // return new AccessHandler($app->make('auth'));
            return $app->build(AccessHandler::class);
        });
    }
}