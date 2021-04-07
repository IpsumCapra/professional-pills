<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiRoleAuth
{
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        dd([
            'req' => $request,
            'usr' => $request->user('api'),
            'abl' => $abilities
        ]);
        foreach ($abilities as $ability) {
            if (!$request->user()->tokenCan($ability)) {
                abort(400, 'Access denied');
            }
        }

        return $next($request);
    }
}
