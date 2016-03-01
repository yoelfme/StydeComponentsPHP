<?php
namespace Styde;

class SessionArrayDriver
{
    protected $data;

    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    public function load()
    {
        return $this->data();
    }
}
