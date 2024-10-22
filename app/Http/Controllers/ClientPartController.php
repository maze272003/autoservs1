<?php

namespace App\Http\Controllers;

use App\Models\ClientPart;
use App\Models\User;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class ClientPartController extends Controller
{
    // Method to show the form for adding parts
    public function create()
    {
        $users = User::all(); // Fetch all users
        $parts = Part::all(); // Fetch all parts

        return view('admin.createparts', compact('users', 'parts'));
    }

    // Method to store client parts
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'process_id' => 'required|exists:processes,id', // Use process_id instead of user_id
            'parts_ids' => 'required|array',
            'parts_ids.*' => 'exists:parts,id',
        ]);

        foreach ($validatedData['parts_ids'] as $partId) {
            $part = Part::findOrFail($partId);

            if ($part->quantity > 0) {
                // Add part to the client with a process_id
                ClientPart::create([
                    'user_id' => Auth::id(), // Store the user_id for reference if needed
                    'parts_id' => $partId,
                    'process_id' => $validatedData['process_id'], // Use the process ID
                ]);

                // Reduce the quantity of the part in the parts table
                $part->quantity -= 1;
                $part->save();
            } else {
                return redirect()->back()->with('error', "Insufficient quantity for part: {$part->name_parts}");
            }
        }

        return redirect()->back()->with('success', 'Parts added successfully!');
    }

    // Custom method to generate process ID
    protected function generateProcessId()
    {
        // You can use a random number, a UUID, or fetch an ID from another table
        return uniqid();  // Example: using PHP's uniqid() to generate a unique ID
    }

    // Method to decline a part and restore the quantity
    public function decline($id)
{
    // Find the client part by ID
    $clientPart = ClientPart::findOrFail($id);

    // Restore the quantity of the part
    $part = Part::findOrFail($clientPart->parts_id);
    $part->increment('quantity');

    // Delete the client part
    $clientPart->delete();

    return redirect()->back()->with('success', 'Part declined and quantity restored successfully.');
}


    // Method to get part details as an array (useful for JSON responses)
    public function getDetails($id)
    {
        $clientPart = ClientPart::findOrFail($id);
        return response()->json($clientPart->getPartsAsArray());
    }

}
