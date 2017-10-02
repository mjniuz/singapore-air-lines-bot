<?php namespace App\Bot\Services\Bot;

use GuzzleHttp\Client as GuzzleHttpLibrary;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

/**
 * class extend from guzzle for send data to bot
 */
class Bot extends GuzzleHttpLibrary
{
    protected $endpoint;
    protected $service;
    protected $method;
    protected $version;
    protected $body    = [];
    protected $headers = [];

    public function __construct()
    {
        $this->endpoint = env('FACEBOOK_ENDPOINT'); // get endpoint
        $this->method   = 'POST'; // set default POST method
        $this->version  = '/v2.6'; //set default version 1

        parent::__construct([
            RequestOptions::CONNECT_TIMEOUT => 30,
            RequestOptions::TIMEOUT         => 20,
        ]);

        $this->headers = [
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * handling response from bot
     * @return array
     */
    public function handler()
    {
        try {
            // decode process end send
            $data_response = json_decode($this->_send());
            $ex            = [
                'http_code' => 200,
                'message'   => $data_response,
            ];

            return $ex;
        }
        catch (\Exception $ex)
        {
            // if error save to log
            Log::error($ex);

            // return error message from etalastic
            $message     = json_decode($ex->getMessage());
            $status_code = $ex->getCode();
            $ex          = [
                'http_code' => $status_code,
                'message'   => $message,
            ];

            return $ex;
        }
    }

    /**
     * this function for check mobile or email
     *
     * @param  string   $params The parameters
     * @return array
     */
    public function getFacebookReplyMessege(array $params)
    {
        $this->body    = $params; //data in body
        $this->method  = 'POST'; // method
        $this->service = '/me/messages?access_token=' . env('FACEBOOK_TOKEN'); // url

        return $this->handler();
    }

    /**
     * get facebooku. user detail
     * @param  integer  $facebook_id
     * @return array
     */
    public function getUserFacebookDetail($facebook_id)
    {
        $this->method  = 'GET'; // method
        $this->service = '/' . $facebook_id . '?fields=first_name,last_name,profile_pic,timezone,gender&access_token=' . env('FACEBOOK_TOKEN');

        return $this->handler();
    }

    /**
     * send data via guzzle to etalastic
     * @return string
     */
    private function _send()
    {
        $this->service = $this->endpoint . $this->version . $this->service;
        $response      = $this->request($this->method, $this->service, [
            'base_uri'              => $this->service,
            RequestOptions::HEADERS => $this->headers,
            RequestOptions::JSON    => $this->body,
        ]);
        $content_response = $response->getBody()->getContents();

        return $content_response;
    }

}
