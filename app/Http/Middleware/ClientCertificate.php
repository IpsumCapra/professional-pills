<?php

namespace App\Http\Middleware;


class ClientCertificate
{
    public function handle($request, $next, $guard = null)
    {
        return $next($request);
    }
}
