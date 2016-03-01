<?php
namespace Styde\Stubs;

use Styde\User;
use Styde\AuthenticatorInterface;

class AuthenticatorStub implements AuthenticatorInterface
{
    protected $logged;

    public function __construct($logged = true)
    {
        $this->logged = $logged;
    }

    public function check()
    {
        return $this->logged;
    }

    public function user()
    {
        return new User([
            'name' => 'Yoel',
            'role' => 'admin'
        ]);
    }
}
