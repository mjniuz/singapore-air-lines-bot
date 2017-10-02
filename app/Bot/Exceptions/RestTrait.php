<?php namespace App\Bot\Exceptions;

use Illuminate\Http\Request;

trait RestTrait
{

    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api/v1'.
     *
     * @param  Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/api') !== false;
    }

}
