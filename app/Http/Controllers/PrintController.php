<?php

namespace App\Http\Controllers;

use App\Models\ClientPart;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function getClientParts($processId)
    {
        // Fetch the parts for the specific process using your model and relationships
        $clientParts = ClientPart::with('part') // Ensure you have the relationship defined in the model
            ->where('process_id', $processId) // Assuming you have a process_id in client_parts
            ->get();

        return response()->json(['clientParts' => $clientParts]);
    }
}
