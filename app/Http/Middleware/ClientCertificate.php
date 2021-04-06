<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class ClientCertificate
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
        dd(['req' => $request, 'ver' => $request->server('SSL_CLIENT_VERIFY')]);

        if ($this->auth->guard($guard)->check()) {
            return $next($request);
        }

        if (! $request->secure()) {
            return abort(400, 'The Client Certificate auth requires a HTTPS connection.');
        }

        // If the certificate is valid, log in and remember the user.
        if ($request->server('SSL_CLIENT_VERIFY') === 'SUCCESS') {
            $this->auth->guard($guard)->login(static::getUserFromCert($request), true);

            return $next($request);
        }

        throw new AuthenticationException('Unauthenticated.');
    }
}
