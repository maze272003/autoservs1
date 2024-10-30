<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Process;
use App\Models\Part; // Ensure this line is added to import the Part model
use Illuminate\Http\Request;
use App\Models\ClientPart; // Ensure this line is added
use App\Models\HistoryCar;  // Ensure this line is added
use App\Models\HistoryPart; // Ensure this line is added

class ProcessController extends Controller
{
    // Fetch all bookings and pass them to the 'admin.bookings.index' view
    public function index()
    {
        $bookings = Booking::with('user')->get();
        return view('admin.bookings.index', compact('bookings'));
    }
    
    // Fetch all processes with related users and payment proofs
    public function inProcess()
    {
        $processes = Process::with('user')->get();
        return view('admin.inprocess', compact('processes'));
    }

    // Show the process table with parts available for selection
    public function showProcessTable()
    {
        $processes = Process::with('user')->get(); // Get processes with related users
        $parts = Part::all(); // Fetch all parts
        return view('admin.inprocess', compact('processes', 'parts')); // Pass both to the view
    }

    // Process a booking and create a new process record, then delete the booking
    public function process($id)
    {
        $booking = Booking::findOrFail($id);

        // Create a new process based on the booking data
        Process::create([
            'carModel' => $booking->carModel,
            'serviceType' => $booking->serviceType,
            'carIssue' => $booking->carIssue,
            'appointmentDate' => $booking->appointmentDate,
            'appointmentTime' => $booking->appointmentTime,
            'plateNumber' => $booking->plateNumber,
            'additionalNotes' => $booking->additionalNotes,
            'user_id' => $booking->user_id,
        ]);

        // Delete the booking
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking processed successfully.');
    }

    // Mark a process as done and move data to history tables (cars and parts)
    public function markAsDone($id)
    {
        $process = Process::findOrFail($id);

        // Transfer the process data to the history_cars table
        $historyCar = new HistoryCar();
        $historyCar->user_id = $process->user_id; // Ensure this is set for the history car
        $historyCar->carModel = $process->carModel;
        $historyCar->serviceType = $process->serviceType;
        $historyCar->carIssue = $process->carIssue;
        $historyCar->appointmentDate = $process->appointmentDate;
        $historyCar->appointmentTime = $process->appointmentTime;
        $historyCar->plateNumber = $process->plateNumber;
        $historyCar->additionalNotes = $process->additionalNotes;
        $historyCar->save();

        // Fetch all parts related to the process (from client_parts table)
        $clientParts = ClientPart::where('process_id', $process->id)->with('part')->get(); // Filter by process_id

        // Move the parts from client_parts to history_parts
        foreach ($clientParts as $clientPart) {
            if ($clientPart->parts_id) {
                $historyPart = new HistoryPart();
                $historyPart->history_car_id = $historyCar->id; // Foreign key to history_cars
                $historyPart->part_id = $clientPart->parts_id;
                $historyPart->part_name = $clientPart->part->name_parts ?? 'N/A';
                $historyPart->part_price = $clientPart->part->price ?? 0;
                $historyPart->user_id = $process->user_id; // Set user_id for history_part
                $historyPart->save();
            }
        }

        // Remove client parts after transferring to history
        ClientPart::where('process_id', $process->id)->delete(); // Use process_id to delete only relevant parts

        // Mark the process as done by deleting it
        $process->delete();

        return redirect()->back()->with('success', 'Process and parts have been marked as done and moved to history.');
    }

    // Upload a proof of payment
    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'proof_payment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        $process = Process::findOrFail($id);

        if ($request->hasFile('proof_payment')) {
            // Upload the file and store it in 'uploads/proofs'
            $imageName = time().'.'.$request->proof_payment->extension();
            $request->proof_payment->move(public_path('uploads/proofs'), $imageName);

            // Save the file path in the proof_payment column
            $process->proof_payment = $imageName;
            $process->save();
        }

        return redirect()->back()->with('success', 'Payment proof uploaded successfully!');
    }
    public function deletePart($processId, $partId)
{
    // Find and delete the ClientPart record
    $clientPart = ClientPart::where('process_id', $processId)->where('id', $partId)->first();
    if ($clientPart) {
        $clientPart->delete();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
}


}
