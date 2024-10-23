<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Make sure this points to your Message model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add this line
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

    public function showNotifications()
    {
        // Kunin ang mga mensahe mula sa kasalukuyang user
        $messages = Message::where('email', Auth::user()->email)->get();

        return view('messages.notification', compact('messages'));
    }

    public function deleteMessages(Request $request)
    {
        // Log the incoming request data
        Log::info('Delete request received', $request->all());

        // Validate the incoming request
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:messages,id', // Ensure each ID exists in the database
        ]);

        // Delete the messages using the IDs provided
        Message::destroy($request->ids);

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}
