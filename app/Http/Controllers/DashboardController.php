<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers;

use App\ConnectedAccount;
use Cache;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');

        view()->share('currentDashboardPage', 'home');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
