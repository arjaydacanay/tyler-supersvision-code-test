<?php
namespace Interview\Abstraction;

class WarrantResponse implements Response
{
      /** @var int */
      protected $responseCode;
      /** @var string */
      protected $responsePayload;
   /**
     * @param int $responseCode
     * @param string $responsePayload
     * 
     */
    public function __construct($responseCode, $responsePayload)
    {
        $this->responseCode = $responseCode;
        $this->responsePayload = $responsePayload;
    }

      /**
     * Returns the HTTP status code response
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->responseCode;
    }

     /**
     * Returns the HTTP status code response
     *
     * @return string
     */
    public function getBody()
    {
        return $this->responsePayload;
    }

}