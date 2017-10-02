<?php namespace App\Http\Controllers\Api;

use App\Bot\Api\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $response;
    protected $http_response_code = 200;

    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->response = new ApiResponse;
    }
}
