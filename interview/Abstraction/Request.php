<?php

namespace Interview\Abstraction;

interface Request
{

    /**
     * Returns the HTTP method used in the request
     *
     * @return string
     */
    public function getMethod();

    /**
     * Returns the payload provided in the request
     *
     * @return string
     */
    public function getPayload();

}