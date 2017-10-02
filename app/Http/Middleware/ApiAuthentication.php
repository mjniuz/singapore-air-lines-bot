<?php namespace App\Http\Middleware;

use App\Bot\Services\Slack\Slack;
use Closure;

class ApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('APP_ENV') != 'local')
        {
            Slack::sendNotifyRequest($request->all(), $request->url());
        }
        return $next($request);
    }
}
