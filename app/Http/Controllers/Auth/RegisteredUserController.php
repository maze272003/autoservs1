<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation rules for user registration
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            // Password validation with custom rules
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(), // Applies Laravel's default password rule
                'min:8', // Minimum of 8 characters
                'regex:/[A-Z]/', // Must contain at least one uppercase letter
                'regex:/[a-z]/', // Must contain at least one lowercase letter
                'regex:/[0-9]/', // Must contain at least one number
                'regex:/[@$!%*#?&]/' // Must contain at least one special character
            ],

            'address' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:10'],
            'contact_number' => ['required', 'string', 'max:15'],
            'brgy' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.'
        ]);

        // Creating the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'contact_number' => $request->contact_number,
            'brgy' => $request->brgy,
            'street' => $request->street,
        ]);

        // Triggering the Registered event
        event(new Registered($user));

        // Logging in the user after registration
        Auth::login($user);

        // Redirect to dashboard after successful registration
        return redirect(route('dashboard'));
    }
}
