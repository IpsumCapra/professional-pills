<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class ApiRoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  null|string $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // If the certificate is valid, continue.
        if ($request->server('REDIRECT_SSL_CLIENT_VERIFY') === 'SUCCESS') {
            return $next($request);
        }

        return abort(403);
    }
}
