<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display the staff dashboard or index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('staff.index'); // You may create this view or change as needed
    }
}
