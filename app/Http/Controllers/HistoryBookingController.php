<?php

namespace App\Http\Controllers;

use App\Models\HistoryCar;
use Illuminate\Http\Request;

class HistoryBookingController extends Controller
{
    /**
     * Display the client's maintenance history.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function clientMaintenanceHistory(Request $request)
    {
        // Fetch the client's maintenance history
        $historyCars = HistoryCar::with(['user', 'historyParts']) // Use array syntax for clarity
            ->where('user_id', $request->user()->id) // Filter based on the authenticated user
            ->get();

        // Pass the data to the view
        return view('ClientHistory.maintenanceHistory', compact('historyCars'));
    }
}
