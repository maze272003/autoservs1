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
            'user_id' => 'required|exists:users,id',
            'parts_ids' => 'required|array',
            'parts_ids.*' => 'exists:parts,id',
        ]);

        foreach ($validatedData['parts_ids'] as $partId) {
            // Fetch the part to check quantity
            $part = Part::findOrFail($partId);

            if ($part->quantity > 0) {
                // Add part to the client
                ClientPart::create([
                    'user_id' => $validatedData['user_id'],
                    'parts_id' => $partId,
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

    // Method to decline a part and restore the quantity
    public function decline($id)
    {
        // Find the client part record by its ID
        $clientPart = ClientPart::findOrFail($id);

        // Ensure that the client part belongs to the authenticated user
        if ($clientPart->user_id === Auth::id()) {  // Use the Auth facade here
            // Restore the quantity of the part in the parts table
            $part = Part::findOrFail($clientPart->parts_id);
            $part->quantity += 1;
            $part->save();

            // Delete the client part record
            $clientPart->delete();

            return redirect()->back()->with('success', 'Part declined and quantity restored successfully.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}
