<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiRoleAuth
{
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        // Grant admin immediate access.
        if ($request->user('api')->tokenCan('admin')) {
            return $next($request);
        }

        // Check if all role goals are correct.
        foreach ($abilities as $ability) {
            if (!$request->user('api')->tokenCan($ability)) {
                abort(403);
            }
        }

        // If everything checks out, proceed.
        return $next($request);
    }
}
