<?php

namespace App\Http\Controllers;

use App\Models\ApiUser;
use Illuminate\Http\Request;
use Session;

class ApiAuthController extends Controller
{
    // Login route
    public function login(Request $request)
    {
        dd($request);
        $division = $request->server('REDIRECT_SSL_CLIENT_S_DN_CN');



        switch ($division) {
            case 'MD':

        }

        $user = ApiUser::create([

        ]);

        $token = $user->createToken('auth_token');

        return ['token' => $token->plainTextToken];

        // When not successfull go back with error
        return back()->withInput()->with('error', __('auth.login.error'));
    }
}
