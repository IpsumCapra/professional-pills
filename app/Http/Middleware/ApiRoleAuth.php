<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiRoleAuth
{
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        $user = $request->user('api');
        // Abort if invalid token is used.
        if ($user === null) {
            abort(403);
        }

        // Grant admin immediate access.
        if ($user->tokenCan('admin')) {
            return $next($request);
        }

        // Check if all role goals are correct.
        foreach ($abilities as $ability) {
            if (!$user->tokenCan($ability)) {
                abort(403);
            }
        }

        // If everything checks out, proceed.
        return $next($request);
    }
}
