<?php
namespace Styde;

class Container
{
    protected $bindings = [];

    public function bind($name, $resolver)
    {
        $this->bindigns[$name] = [
            'resolver' => $resolver
        ];
    }

    public function make($name)
    {
        $resolver = $this->bindigns[$name]['resolver'];

        $object = $resolver($this);

    }
}
