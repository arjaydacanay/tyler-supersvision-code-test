<?php

namespace Interview\Abstraction;

interface Response
{

    /**
     * Returns the HTTP status code for the request
     *
     * @return int
     */
    public function getStatusCode();

    /**
     * Returns the body of the response
     *
     * @return string
     */
    public function getBody();

}