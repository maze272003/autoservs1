<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerSupportController extends Controller
{
    public function index()
    {
        return view('customer-support'); // Replace 'customer-support' with your actual view file name
    }
}
