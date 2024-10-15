<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;  // Add for handling file storage
use Illuminate\View\View;
use App\Models\User;  // Ensure the User model is imported
use Intervention\Image\Facades\Image; // Import the Image facade

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Fill the user with validated data, including new fields
        $user->fill($request->validated());

        // Check if the email has changed and set email_verified_at to null
        if ($request->user()->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the user data
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Handle profile image upload and update.
     */
    public function updateImage(Request $request): RedirectResponse
    {
        // Validate the image upload
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated user
        $user = Auth::user();  // Ensure $user is correctly assigned

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Store new image
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        // Save the updated user information
        $user->save();  // Make sure $user is correctly initialized

        return Redirect::route('profile.edit')->with('status', 'profile-image-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
