<?php
namespace Styde;

use Styde\Authenticator as Auth;

class AccessHandler
{

    protected $auth = null;

    /**
     * @param Styde\Authenticator $auth
     */
    public function __construct($auth)
    {
        $this->auth = $auth;
    }
    
    public function check($role)
    {
        return $this->auth->check() && $this->auth->user()->role === $role;
    }
}
