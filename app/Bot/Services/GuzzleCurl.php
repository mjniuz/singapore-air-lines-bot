<?php namespace Qasir\Services;

use GuzzleHttp\Client as GuzzleHttpLibrary;

class GuzzleCurl extends GuzzleHttpLibrary
{
    const METHOD_POST = "post";
    const METHOD_GET  = "get";

    protected $headers = [];
    protected $endpoint;
    protected $body;
    protected $method;
    // protected $response;

    public function __construct()
    {

    }

    /**
     * this function set endpoint for hit API from guzzle
     *
     * @param object $endpoint The endpoint
     */
    protected function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * this function for set header for hit API from guzzle
     *
     * @param object $headerArray The header array
     */
    protected function setHeaders($headerArray)
    {
        if (is_object($headerArray))
        {
            $this->headers = $headerArray;
        }
    }

    /**
     * this function for set body for hit API from guzzle
     *
     * @param object $body The body
     */
    protected function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * this function for set method
     *
     * @param GuzzleCurl $method The method
     */
    protected function setMethod(GuzzleCurl $method)
    {
        $this->method = $method;
    }

    /**
     * this function for hit API from guzzle
     *
     * @return object
     */
    protected function send()
    {
        $request = $this->client->$method($this->endpoint, $this->headers, array());
        $request->setBody($this->body);
        $response = $request->send();

        return $response;
        // $request = new Request($this->method, $this->endpoint, $this->headers, $this->body);
    }
}
