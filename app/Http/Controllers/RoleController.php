<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Logic for your dashboard (if any)
        return view('admin.dashboard'); // Make sure this matches the view file name
    }
}
