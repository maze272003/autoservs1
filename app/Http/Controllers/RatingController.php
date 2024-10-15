<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the rating input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Store the rating
        Rating::create([
            'user_id' => Auth::id(), // Get the logged-in user's ID
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Rating submitted successfully!');
    }
}
