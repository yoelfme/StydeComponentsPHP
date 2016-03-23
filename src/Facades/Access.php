<?php
namespace Styde\Facades;

use Styde\Container;

class Access
{

    public static function check($role)
    {
        $access = Container::getInstance()->make('access');

        return $access->check($role);
    }
}
