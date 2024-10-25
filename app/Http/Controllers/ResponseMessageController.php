<?php

namespace App\Http\Controllers;

use App\Models\Message; // Make sure to import your Message model
use App\Models\Reply; // Import your Reply model
use Illuminate\Http\Request;

class ResponseMessageController extends Controller
{
    /**
     * Display all messages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all messages from the database
        $messages = Message::all();

        // Pass the messages to the view
        return view('admin.responseMessage', compact('messages'));
    }
    public function storeReply(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'message_id' => 'required|integer|exists:messages,id', // Ensure the message exists
        'reply' => 'required|string',
    ]);

    // Create a new reply record in the replies table
    Reply::create([
        'user_id' => auth()->id(), // Assuming you want to associate the reply with the logged-in user
        'message_id' => $request->message_id,
        'messages' => $request->reply,
    ]);

    return response()->json(['success' => true]);

}

public function reply(Request $request)
{
    $request->validate([
        'messageId' => 'required|integer|exists:messages,id',
        'replyMessage' => 'required|string',
    ]);

    // Store the reply in the replies table
    Reply::create([
        'user_id' => auth()->id(), // Get the ID of the currently authenticated user
        'message_id' => $request->messageId,
        'reply' => $request->replyMessage,
    ]);

    
}

public function destroy($id)
    {
        // Find the message by ID and delete it
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully!']);
    }
}
