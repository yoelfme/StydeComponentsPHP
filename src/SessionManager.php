<?php
namespace Styde;

class SessionManager
{

    protected $loaded = false;
    protected $data = [];

    public function __construct(SessionFileDriver $driver)
    {
        $this->driver = $driver;

        $this->load();
    }

    protected function load()
    {
        $this->data = $this->driver->load();
    }

    public function get($key)
    {
        return isset($this->data[$key])
            ? $this->data[$key]
            : null;
    }
}
