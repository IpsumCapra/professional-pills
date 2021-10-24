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
        $division = $request->server('REDIRECT_SSL_CLIENT_S_DN_CN');
        $email = $request->server('REDIRECT_SSL_CLIENT_S_DN_Email');

        if ($email === null) {
            return back()->withInput()->with('error', __('auth.login.error'));
	}

	// Set user ability based on division field in SSL cert.
        switch ($division) {
            case 'MD':
                $ability = 'md';
                break;
            case 'LG':
                $ability = 'logistics';
                break;
            case 'RD':
                $ability = 'rnd';
                break;
            case 'IT':
                $ability = 'admin';
                break;
            default:
                return back()->withInput()->with('error', __('auth.login.error'));
        }

	// Create user.
        $user = ApiUser::create([
            'email' => $email,
            'division' => $division
        ]);

	// Create relevant API token with ability.
        $token = $user->createToken('auth_token', [$ability]);


	// Display token for user.
        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer'
        ]);

        // When not successfull go back with error
        return back()->withInput()->with('error', __('auth.login.error'));
    }
}
