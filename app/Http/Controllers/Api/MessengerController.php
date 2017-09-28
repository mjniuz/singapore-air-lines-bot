<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class MessengerController extends ApiController
{
    public function index(Request $request)
    {
        return "OK";
    }
}
