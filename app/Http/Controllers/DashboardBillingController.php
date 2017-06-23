<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers;

use Exception;
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

    public function update(Request $request)
    {
        $this->validate($request, [
            'stripeToken' => 'required',
            'name' => 'required',
            'address_line1' => 'required',
            'address_city' => 'required',
            'address_state' => 'required',
            'address_zip' => 'required',
        ]);

        try {
            /** @var \App\User $user */
            $user = auth()->user();

            if ($user->hasStripeId()) {
                $customer = $user->asStripeCustomer();

                $customer->description = "[{$user->id}] {$user->name}";
                $customer->email = $user->email;
                $customer->metadata['id'] = $user->id;
                $customer->source = $request->stripeToken;
                $customer->shipping = [
                    'name' => $user->name,
                    'address' => [
                        'line1' => $request->address_line1,
                        'line2' => $request->address_line2,
                        'city' => $request->address_city,
                        'state' => $request->address_state,
                        'country' => 'Canada',
                        'postal_code' => $request->address_zip,
                    ],
                ];

                $customer->save();

                $user->updateCardFromStripe();
            } else {
                $user->createAsStripeCustomer($request->stripeToken, [
                    'description' => "[{$user->id}] {$user->name}",
                    'metadata' => [
                        'id' => $user->id,
                    ],
                    'shipping' => [
                        'name' => $user->name,
                        'address' => [
                            'line1' => $request->address_line1,
                            'line2' => $request->address_line2,
                            'city' => $request->address_city,
                            'state' => $request->address_state,
                            'country' => 'Canada',
                            'postal_code' => $request->address_zip,
                        ],
                    ],
                ]);
            }
        } catch (Exception $exception) {
            dd($exception);
        }

        flash(__('You have successfully changed your billing details!'))->success();

        return redirect()->back();
    }
}
