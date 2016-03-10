<?php

class ContainerTest extends PHPUnit_Framework_TestCase
{

    public function test_bind_from_closure()
    {
        $container = new Container();

        $container->bind('key', function () {
            return 'Object';
        });

        $this->assertSame('Object', $container->make('key'));
    }
}
