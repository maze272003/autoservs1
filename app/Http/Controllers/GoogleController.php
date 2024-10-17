<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if the user already exists
        $authUser = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'google_verified' => $googleUser->user['verified_email'] ?? false, // Google returns `verified_email`
                // Other fields to update
            ]
        );

        // Log in the user
        Auth::login($authUser);

        return redirect()->intended('dashboard');
    }

}
