<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Part; // Ensure to import the Part model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClientPart; // Assuming ClientPart is your model for client parts

class ShowProcessController extends Controller
{
    public function index()
{
    $processes = Process::with(['user', 'clientParts.part'])->get(); // Eager load user and related parts
    $parts = Part::all(); // Fetch all parts (assuming you have a Part model)

    return view('admin.inprocess', compact('processes', 'parts'));
}

    public function storeParts(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'parts_ids' => 'required|array',
            'parts_ids.*' => 'exists:parts,id',
        ]);

        foreach ($request->parts_ids as $partId) {
            // Store the part for the user in a separate table
            DB::table('client_parts')->insert([
                'user_id' => $request->user_id,
                'parts_id' => $partId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Parts added successfully.');
    }
}
