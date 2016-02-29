<?php

use Styde\AccessHandler as Access;
use Styde\Authenticator as Auth;
use Styde\SessionManager as Session;
use Styde\SessionFileDriver as SessionFileDriver;

class AccessHandlerTest extends PHPUnit_Framework_TestCase
{

    public function test_grant_access()
    {
        $sessionFileDriver = new SessionFileDriver();
        $session = new Session($sessionFileDriver);
        $auth = new Auth($session);
        $access = new Access($auth);


        $this->assertTrue(
            $access->check('admin')
        );
    }

    public function test_denny_access()
    {
        $sessionFileDriver = new SessionFileDriver();
        $session = new Session($sessionFileDriver);
        $auth = new Auth($session);
        $access = new Access($auth);

        $this->assertFalse(
            $access->check('editor')
        );
    }
}
