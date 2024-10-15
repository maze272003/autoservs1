<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;

class PartController extends Controller
{
    
    // Display the form
    public function create()
    {
        $parts = Part::all();
        return view('admin.createparts', compact('parts'));
    }

    // Store the new part
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name_parts' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        // Create new part
        Part::create($validatedData);

        // Redirect back with success message
        return redirect()->route('admin.createparts')->with('success', 'New part added successfully!');
    }
    // Show the edit form
public function edit($id)
{
    $part = Part::findOrFail($id);
    return view('admin.editparts', compact('part'));
}

// Update the part in storage
public function update(Request $request, $id)
{
    $part = Part::findOrFail($id);
    $part->update($request->validate([
        'name_parts' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]));

    return redirect()->route('parts.create')->with('success', 'Part updated successfully.');
}

// Delete the part
public function destroy($id)
{
    $part = Part::findOrFail($id);
    $part->delete();

    return redirect()->route('parts.create')->with('success', 'Part deleted successfully.');
}
}
