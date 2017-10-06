<?php namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;

class AdminAuthentication
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
        // check login
        if (!Auth::check())
        {
            return redirect()->back();
        }

        // check access user
        if (Auth::user()->access != User::ADMIN)
        {
            return redirect()->back();
        }

        return $next($request);
    }
}
