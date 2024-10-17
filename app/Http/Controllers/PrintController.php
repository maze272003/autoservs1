<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Part;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function showInProcess()
{
    // Fetch all processes with related user and parts
    $processes = Process::with(['user', 'clientParts.part'])->get();

    // Fetch all available parts (for adding new parts)
    $parts = Part::all();

    // Pass this data to the view
    return view('admin.inprocess', compact('processes', 'parts'));
}

}
