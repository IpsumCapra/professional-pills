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
        dd($request);

        // When not successfull go back with error
        return back()->withInput()->with('error', __('auth.login.error'));
    }
}
