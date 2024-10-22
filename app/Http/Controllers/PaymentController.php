<?php

namespace App\Http\Controllers;

use App\Models\Process; // Import the Process model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure to import the Auth facade
class PaymentController extends Controller
{
    

public function showPayment()
{
    // Fetch processes for the authenticated user along with their client parts
    $processes = Process::with(['clientParts.part'])
        ->where('user_id', Auth::id()) // Filter by the authenticated user's ID
        ->get()
        ->map(function ($process) {
            // Calculate total price of parts for each process
            $process->totalPrice = $process->clientParts->sum(function ($clientPart) {
                return $clientPart->part->price ?? 0; // Sum the price of each part
            });
            return $process;
        });

    // Return the payment view with the processes data
    return view('payment', compact('processes'));
}

}
