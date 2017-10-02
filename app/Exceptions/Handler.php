<?php namespace App\Exceptions;

use App\Bot\Exceptions\RestExceptionHandlerTrait;
use App\Bot\Exceptions\RestTrait;
use App\Bot\Services\Slack\Slack;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use RestExceptionHandlerTrait, RestTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        \HttpResponseException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  \Exception                  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $env = env('APP_ENV');
        switch ($env)
        {
            case 'local':
                $retval = parent::render($request, $e);
                break;
            default:
                // send notification to slack
                // and Only notify internal server error
                if (!($e instanceof \HttpResponseException) &&
                    !($e instanceof ModelNotFoundException) &&
                    !($e instanceof AuthenticationException) &&
                    !($e instanceof AuthorizationException) &&
                    !($e instanceof ValidationException && $e->getResponse())
                )
                {
                    Slack::sendNotifyError($request->url(), $request->all(), $e->getMessage(), $e->getFile());
                }
                $retval = parent::render($request, $e);
                if (!$this->isApiCall($request))
                {
                    if (!($e instanceof \HttpResponseException) &&
                        !($e instanceof ModelNotFoundException) &&
                        !($e instanceof AuthenticationException) &&
                        !($e instanceof AuthorizationException) &&
                        !($e instanceof ValidationException && $e->getResponse()) &&
                        !$this->isHttpException($e)
                    )
                    {
                        $retval = response()->view('errors.500');
                    }
                    else
                    {
                        $retval = parent::render($request, $e);
                    }
                }
                else
                {

                    if (!($e instanceof \HttpResponseException))
                    {
                        // Show appropriate error response for API
                        $retval = $this->getJsonResponseForException($request, $e);
                    }
                    else
                    {
                        $retval = parent::render($request, $e);
                    }
                }
        }

        return $retval;
        // return parent::render($request, $exception);
    }
}
