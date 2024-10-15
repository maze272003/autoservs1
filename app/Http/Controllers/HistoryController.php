<?php

// App\Http\Controllers\HistoryController.php
namespace App\Http\Controllers;

use App\Models\HistoryCar;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Fetch all history cars with related parts and user information
        $historyCars = HistoryCar::with(['historyParts', 'user'])->get(); // Include user relationship

        return view('history.index', compact('historyCars'));
    }
}
