<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiRoleAuth
{
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        abort (403);
        foreach ($abilities as $ability) {
            if (!$request->user()->tokenCan($ability)) {
                abort(400, 'Access denied');
            }
        }

        abort(403);
    }
}
