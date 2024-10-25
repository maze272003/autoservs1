<?php

namespace App\Http\Controllers;

use App\Models\ClientPart;
use App\Models\Booking;
use App\Models\CancelledBooking;
use App\Models\Process;
use Illuminate\Support\Facades\Auth;

class CardDashboardController extends Controller
{
    public function index()
    {
        // Get authenticated user's ID
        $userId = Auth::id();

        // Count all added parts specifically for the authenticated user using processes table
        $userAddedPartsCount = ClientPart::whereHas('process', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        // Fetch bookings for the authenticated user
        $bookings = Booking::where('user_id', $userId)->get();
        $bookingCount = $bookings->count();

        // Pass the variables to the view
        return view('dashboard', compact('bookings', 'bookingCount', 'userAddedPartsCount'));
    }

    public function showDashboard()
    {
        // Get authenticated user's ID
        $userId = Auth::id();

        // Count added parts specifically for the authenticated user using processes table
        $userAddedPartsCount = ClientPart::whereHas('process', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        // Fetch all bookings for the authenticated user
        $bookings = Booking::where('user_id', $userId)->get();
        $bookingCount = $bookings->count();

        // Fetch all canceled bookings for the authenticated user
        $canceledBookings = CancelledBooking::where('user_id', $userId)->get();
        $canceledCount = $canceledBookings->count();

        // Fetch 'in process' bookings for the authenticated user
        $processes = Process::where('user_id', $userId)
            ->where('status', 'in process')
            ->get();
        $processCount = $processes->count();

        // Fetch 'pending' bookings for the authenticated user
        $pendingBookings = Booking::where('user_id', $userId)
            ->where('status', 'pending')
            ->get();

        // Pass all relevant data to the view
        return view('dashboard', compact(
            'userAddedPartsCount',
            'bookings', 
            'bookingCount', 
            'canceledBookings', 
            'canceledCount', 
            'processes', 
            'processCount', 
            'pendingBookings'
        ));
    }
}
