<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard or index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index'); // You may create this view or change as needed
    }
}
