<?php
namespace Styde;

use Closure;
use ReflectionClass;

class Container
{
    protected $bindings = [];

    protected $shared = [];

    public function bind($name, $resolver)
    {
        $this->bindigns[$name] = [
            'resolver' => $resolver
        ];
    }

    public function instance($name, $object)
    {
        $this->shared[$name] = $object;
    }

    public function make($name)
    {
        if (isset($this->shared[$name])) {
            return $this->shared[$name];
        }

        $resolver = $this->bindigns[$name]['resolver'];

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        } else {
            $object = $this->build($resolver);
        }

        return $object;
    }

    public function build($name)
    {
        $reflection = new ReflectionClass($name);

        if (!$reflection->isInstantiable()) {
            throw new InvalidArgumentException($name.' is not instantiable');
        }

        $constructor = $reflection->getConstructor(); // ReflectionMethod

        if (is_null($constructor)) {
            return new $name;
        }

        $constructorParameters = $constructor->getParameters(); // ReflectionParameter

        $arguments = [];

        foreach ($constructorParameters as $constructorParameter) {
            $parameterClassName = $constructorParameter->getClass()->getName();

            $arguments[] = $this->build($parameterClassName);
        }

        // new Foo($bar)
        return $reflection->newInstanceArgs($arguments);

    }
}
