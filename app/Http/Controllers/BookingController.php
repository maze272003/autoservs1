<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CancelledBooking;
use App\Models\Process;
use App\Models\ClientPart; // Import ClientPart model

class BookingController extends Controller
{
    public function index()
    {
        // Fetch all bookings along with user information
        $bookings = Booking::with('user')->get();

        // Pass the bookings variable to the view
        return view('admin.bookings.index', compact('bookings')); // Ensure 'bookings' is passed correctly
    }

//   public function showDashboard()
// {
//     $userId = auth()->id();

//     // Fetch all bookings for the authenticated user
//     $bookings = Booking::where('user_id', $userId)->get();
//     $bookingCount = $bookings->count();

//     // Fetch all canceled bookings for the authenticated user
//     $canceledBookings = CancelledBooking::where('user_id', $userId)->get();
//     $canceledCount = $canceledBookings->count();

//     // Fetch 'in process' bookings for the authenticated user
//     $processes = Process::where('user_id', $userId)
//         ->where('status', 'in process')
//         ->get();
//     $processCount = $processes->count();

//     // Fetch 'pending' bookings for the authenticated user
//     $pendingBookings = Booking::where('user_id', $userId)
//         ->where('status', 'pending')
//         ->get();

//     // Count added parts for the authenticated user
//     $addedPartsCount = ClientPart::where('user_id', $userId)->count();

//     // Fetch added parts for modal display (optional)
//     $clientParts = ClientPart::where('user_id', $userId)->with('part')->get();

//     // Pass all relevant data to the view
//     return view('dashboard', compact('bookings', 'bookingCount', 'canceledBookings', 'canceledCount', 'processes', 'processCount', 'pendingBookings', 'addedPartsCount', 'clientParts'));
// }

    public function store(Request $request)
    {
        // Check if the user's email is verified
        if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->back()->with('error', 'Your email must be verified before you can book. Go to your PROFILE and Verified You Account Thank You!');
        }

        $request->validate([
            'carModel' => 'required|string|max:255',
            'serviceType' => 'required|string',
            'carIssue' => 'nullable|string|max:255',
            'appointmentDate' => 'required|date',
            'appointmentTime' => 'required|date_format:H:i',
            'plateNumber' => 'required|string|max:20',
            'additionalNotes' => 'nullable|string',
        ]);

        Booking::create([
            'carModel' => $request->carModel,
            'serviceType' => $request->serviceType,
            'carIssue' => $request->carIssue,
            'appointmentDate' => $request->appointmentDate,
            'appointmentTime' => $request->appointmentTime,
            'plateNumber' => $request->plateNumber,
            'additionalNotes' => $request->additionalNotes ?? null, // Set to null if not provided
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking created successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        CancelledBooking::create([
            'user_id' => $booking->user_id,
            'carModel' => $booking->carModel,
            'serviceType' => $booking->serviceType,
            'carIssue' => $booking->carIssue,
            'appointmentDate' => $booking->appointmentDate,
            'appointmentTime' => $booking->appointmentTime,
            'plateNumber' => $booking->plateNumber,
            'additionalNotes' => $booking->additionalNotes,
        ]);

        $booking->delete();
        return redirect()->route('dashboard')->with('success', 'Booking canceled successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id); // This should work
        return view('edit_booking', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'carModel' => 'required|string|max:255',
            'serviceType' => 'required|string|max:255',
            'appointmentDate' => 'required|date',
            'appointmentTime' => 'required|date_format:H:i',
            'additionalNotes' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->carModel = $request->carModel;
        $booking->serviceType = $request->serviceType;
        $booking->appointmentDate = $request->appointmentDate;
        $booking->appointmentTime = $request->appointmentTime;
        $booking->additionalNotes = $request->additionalNotes;
        $booking->save();

        return redirect()->route('dashboard')->with('success', 'Booking updated successfully.');
    }
}
