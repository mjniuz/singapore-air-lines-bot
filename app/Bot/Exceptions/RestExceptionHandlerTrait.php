<?php namespace App\Bot\Exceptions;

use App\Bot\Api\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

trait RestExceptionHandlerTrait
{

    /**
     * this function for handling error
     *
     * @var array
     */
    public $response = [
        'status'  => ApiResponse::ERR_PROCESS,
        'message' => 'Bad Request',
        'data'    => [
            'errors' => ['We are facing some technical difficulties. Please try again later.'],
        ],
    ];

    public $notfound_response = [
        'status'  => ApiResponse::ERR_NOT_FOUND,
        'message' => 'Bad Request',
        'data'    => [
            'errors' => ['Http not found.'],
        ],
    ];

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param  Request                         $request
     * @param  Exception                       $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        switch (true)
        {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound();
                break;
            case $this->NotFoundHttpException($e):
                $retval = $this->httpNotFound();
                break;
            default:
                $retval = $this->badRequest();
        }

        return $retval;
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param  string                          $message
     * @param  int                             $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message = 'Bad request', $statusCode = 400)
    {
        return $this->jsonResponse($this->response, $statusCode);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param  string                          $message
     * @param  int                             $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($message = 'Record not found', $statusCode = 404)
    {

        return $this->jsonResponse($this->response, $statusCode);
    }

    protected function httpNotFound($message = '', $statusCode = 404)
    {
        return $this->jsonResponse($this->notfound_response, $statusCode);
    }

    /**
     * Returns json response.
     *
     * @param  array|null                      $payload
     * @param  int                             $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload = null, $statusCode = 404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param  Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * Determine if given exception is an Http not found.
     *
     * @param  Exception $e
     * @return bool
     */
    protected function NotFoundHttpException(Exception $e)
    {
        return $e instanceof NotFoundHttpException;
    }

}
