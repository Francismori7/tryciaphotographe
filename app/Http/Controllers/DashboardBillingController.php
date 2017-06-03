<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardBillingController extends Controller
{
    /**
     * DashboardNotificationsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        view()->share('currentDashboardPage', 'billing');
    }

    public function index()
    {
        return view('dashboard.billing.index');
    }

    public function update(Request $request) {
        dd($request);
    }
}
