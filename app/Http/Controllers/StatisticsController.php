<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryCar;
use App\Models\HistoryPart;
use App\Models\ClientPart;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
{
    // Fetch client parts data to pass to the view
    $clientParts = ClientPart::all();

    // Render the view file and pass the client parts data
    return view('admin.userStatistics', compact('clientParts'));
}


    private function fetchChartData()
    {
        // Count clients (distinct user IDs) per month
        // $clientsCount = HistoryCar::selectRaw('MONTH(appointmentDate) as month, COUNT(DISTINCT user_id) as total')
        //     ->whereYear('appointmentDate', Carbon::now()->year)
        //     ->groupBy('month')
        //     ->pluck('total', 'month')
        //     ->toArray();

        // Count total parts added per month
        // $partsCount = HistoryPart::selectRaw('MONTH(created_at) as month, COUNT(id) as total')
        //     ->whereYear('created_at', Carbon::now()->year)
        //     ->groupBy('month')
        //     ->pluck('total', 'month')
        //     ->toArray();

        // Sum of parts price per month
        // $partsPriceSum = HistoryPart::selectRaw('MONTH(created_at) as month, SUM(part_price) as total')
        //     ->whereYear('created_at', Carbon::now()->year)
        //     ->groupBy('month')
        //     ->pluck('total', 'month')
        //     ->toArray();

        // // Format data for chart consumption
        // return [
        //     'clientsCount' => array_values($clientsCount),
        //     'partsCount' => array_values($partsCount),
        //     'partsPriceSum' => array_values($partsPriceSum),
        //     'months' => array_keys($clientsCount),
        // ];
    }

    public function showClientParts()
    {
        // Fetch all records from client_parts table without relationships
        $clientParts = ClientPart::all(); 

        // Return the view with client parts data
        return view('clientParts.index', compact('clientParts'));
    }
}
