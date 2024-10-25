<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; 
use App\Models\Reply; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

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

        // Create a new message with the user_id
        Message::create([
            'email' => $validated['email'],
            'message' => $validated['message'],
            'user_id' => Auth::id(), // Store the authenticated user's ID
        ]);

        // Redirect back with a success message
        return redirect()->route('customer.support')->with('success', 'Message sent successfully!');
    }

    // Fetch notifications for the current user
    public function showNotifications()
    {
        // Fetch messages for the current user
        $messages = Message::where('email', Auth::user()->email)->get();
        
        // Count unread messages and mark them as read
        $unreadCount = Message::where('email', Auth::user()->email)
                              ->where('read', false)
                              ->count();
        
        // Mark messages as read (optional)
        Message::where('email', Auth::user()->email)
               ->where('read', false)
               ->update(['read' => true]);

        return view('messages.notification', compact('messages', 'unreadCount'));
    }

    // Delete selected messages
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

    // Show all messages for the authenticated user with replies
    public function showMessages()
    {
        // Fetch messages that belong to the authenticated user
        $messages = Message::where('user_id', Auth::id())->with('replies')->get();
    
        return view('messages.notification', compact('messages')); // Ensure you're passing 'messages' to the view
    }

    // Count unread messages for the dashboard
    

}
