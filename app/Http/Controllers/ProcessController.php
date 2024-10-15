<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Process;
use Illuminate\Http\Request;
use App\Models\ClientPart; // Ensure this line is added
use App\Models\HistoryCar;  // Ensure this line is added
use App\Models\HistoryPart; // Ensure this line is added

class ProcessController extends Controller
{
    public function index()
    {
        // Fetch all bookings along with user information
        $bookings = Booking::with('user')->get(); // Ensure this fetches bookings

        // Pass the bookings variable to the view
        return view('admin.bookings.index', compact('bookings')); // Use 'compact' to pass the correct variable
    }

    public function process($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Create a new process record
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

        // Delete the booking record
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking processed successfully.');
    }

    public function markAsDone($id)
    {
        $process = Process::findOrFail($id);

        // Transfer process data to history_cars
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

        // Get all parts related to this process
        $clientParts = ClientPart::where('user_id', $process->user_id)->get();

        // Transfer each part to history_parts
        foreach ($clientParts as $clientPart) {
            if ($clientPart->parts_id) { // Ensure parts_id is valid
                $historyPart = new HistoryPart();
                $historyPart->history_car_id = $historyCar->id; // Foreign key from history_cars
                $historyPart->part_id = $clientPart->parts_id;
                $historyPart->part_name = $clientPart->part->name_parts ?? 'N/A';
                $historyPart->part_price = $clientPart->part->price ?? 0;
                $historyPart->user_id = $process->user_id; // Set user_id for the history part
                $historyPart->save();
            }
        }

        // Delete the client parts after transferring them to history
        ClientPart::where('user_id', $process->user_id)->delete();

        // Mark the process as done by deleting from the processes table
        $process->delete();

        return redirect()->back()->with('success', 'Process and parts have been marked as done and moved to history.');
    }

}
