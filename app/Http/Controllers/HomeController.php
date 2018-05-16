<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['dashboard']]);
    }


    public function dashboard()
    {
        return $this->auth()->check()
            ? view('dashboard')
            : view('dashboardGuests');
    }
}
