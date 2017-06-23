@extends('layouts.dashboard')

@section('title', __('Billing'))

@section('dashboard-page')
    <p class="lead">{{ __('Manage your billing details associated with your account here.') }}</p>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-block">
                    <h4>{{ __('Update your credit card details') }}</h4>

                    <form action="/dashboard/billing" method="post" id="billing-form">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group">
                            <label for="first_name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __('Your name') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="address_line1">{{ __('Address') }}</label>
                            <input type="text" class="form-control" id="address_line1" name="address_line1"
                                   placeholder="{{ __('Address (line 1)') }}" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="address_line2" name="address_line2"
                                   placeholder="{{ __('Address (line 2)') }}">
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="address_city"
                                       placeholder="{{ __('City') }}"
                                       required>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="address_state"
                                       placeholder="{{ __('Province') }}" required maxlength="2">
                            </div>
                            <div class="col-3">
                                <p class="form-control-static">Canada</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="card-element">
                                {{ __('Credit Card') }}
                            </label>
                            <div id="card-element" class="form-control">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors -->
                            <div id="card-errors" class="form-text text-danger" role="alert"></div>
                        </div>

                        <input type="submit" class="btn btn-primary" value="{{ __('Save billing details') }}">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-block">
                    @if(auth()->user()->hasStripeId())
                        <div class="d-flex justify-content-between">
                            <h2>{{ auth()->user()->name }}</h2>
                            <i class="fa fa-credit-card fa-5x text-success"></i>
                        </div>
                        <h4>Carte principale</h4>
                        <div class="card col-4">
                            <div class="card-header">{{ auth()->user()->card_brand }}</div>
                            <div class="card-block">{{ auth()->user()->getCardNumber() }}</div>
                        </div>
                    @else
                        <h4>{{ __('No billing profile has been created') }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection