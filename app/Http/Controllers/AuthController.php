<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    // Login route
    public function login(Request $request)
    {
        // Validate input
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Try to login when successfull go to home page
        if (
        Auth::attempt([
            'email' => $fields['email'],
            'password' => $fields['password']
        ], true)
        ) {
            return redirect()->route('home');
        }

        // When not successfull go back with error
        return back()->withInput()->with('error', __('auth.login.error'));
    }

    // Register route
    public function register(Request $request)
    {
        // Validate input
        $fields = $request->validate([
            'firstname' => 'required|min:2|max:48',
            'insertion' => 'nullable|max:16',
            'lastname' => 'required|min:2|max:48',
            'gender' => 'required|integer|digits_between:' . User::GENDER_MALE . ',' . User::GENDER_OTHER,
            'birthday' => 'required|date',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'nullable|max:255',
            'address' => 'required|min:2|max:255',
            'postcode' => 'required|min:2|max:255',
            'city' => 'required|min:2|max:255',
            'province' => 'required|min:2|max:255',
            'password' => 'required|min:6|confirmed'
        ]);

        // Create user
        $user = User::create([
            'firstname' => $fields['firstname'],
            'insertion' => $fields['insertion'],
            'lastname' => $fields['lastname'],
            'gender' => $fields['gender'],
            'birthday' => $fields['birthday'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'address' => $fields['address'],
            'postcode' => $fields['postcode'],
            'city' => $fields['city'],
            'province' => $fields['province'],
            'password' => Hash::make($fields['password']),

            // First created account is always admin
            'role' => User::count() == 0 ? User::ROLE_ADMIN : User::ROLE_NORMAL
        ]);

        // Get the hospitals in a province.
        $hospitals = Hospital::search($fields['province']);

        // Attach user to closest hospital, or the first available one.
        if ($hospitals->count() > 0) {
            $hospitals->first()->users()->attach($user->id);
        } else {
            $hospitals = Hospital::all();
            if ($hospitals->count() > 0) {
                $hospitals->first()->users()->attach($user->id);
            }
        }

        // Login user in
        Auth::attempt([
            'email' => $fields['email'],
            'password' => $fields['password']
        ], true);

        // Go to home page
        return redirect()->route('home');
    }

    // Logout route
    public function logout()
    {
        // Logout user
        Session::flush();
        Auth::logout();

        // Go to login page
        return redirect()->route('auth.login');
    }
}
