<?php

namespace Test\Abstraction;

use Interview\Abstraction\Request;

class WarrantRequest implements Request
{

    /** @var string */
    protected $method;
    /** @var string */
    protected $payload;

    /**
     * @param string $method
     * @param string $payload
     * @param array $headers
     */
    public function __construct($method, $payload)
    {
        $this->method = $method;
        $this->payload = $payload;
    }

    /**
     * Returns the HTTP method used in the request
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Returns the payload provided in the request
     *
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

}