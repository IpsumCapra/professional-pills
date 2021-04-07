<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class ApiAuthController extends Controller
{
    // Login route
    public function login(Request $request)
    {
        $division = $request->server('REDIRECT_SSL_CLIENT_S_DN_CN');

        switch ($division) {
            case 'MD':

        }


        $token = $user->createToken('auth_token');

        return ['token' => $token->plainTextToken];

        // When not successfull go back with error
        return back()->withInput()->with('error', __('auth.login.error'));
    }
}
