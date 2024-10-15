<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Make sure this points to your Message model

class MessageController extends Controller
{
    // Show the support form
    public function showForm()
    {
        return view('customer-support'); // Ensure this view exists
    }

    // Handle the form submission
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Create a new message
        Message::create([
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        // Redirect back with a success message
        return redirect()->route('customer.support')->with('success', 'Message sent successfully!');
    }
}
