<?php namespace Qasir\Services;

use GuzzleHttp\Client as GuzzleHttpLibrary;

/**
 *
 */
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

    protected function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    protected function setHeaders($headerArray)
    {
        if (is_object($headerArray))
        {
            $this->headers = $headerArray;
        }
    }

    protected function setBody($body)
    {
        $this->body = $body;
    }

    protected function setMethod(GuzzleCurl $method)
    {
        $this->method = $method;
    }

    protected function send()
    {
        $request = $this->client->$method($this->endpoint, $this->headers, array());
        $request->setBody($this->body);
        $response = $request->send();

        return $response;
        // $request = new Request($this->method, $this->endpoint, $this->headers, $this->body);
    }
}
