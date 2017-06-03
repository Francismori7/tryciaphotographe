@extends('layouts.dashboard')

@section('title', __('Billing'))

@section('dashboard-page')
    <p class="lead">{{ __('Manage your billing details associated with your account here.') }}</p>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-block">
                    <h4>{{ __('Update your credit card details') }}</h4>

                    <form action="/dashboard/billing" method="post" id="payment-form" @submit.prevent="handleBillingForm">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group">
                            <label for="first_name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __('Your name') }}">
                        </div>

                        <div class="form-group">
                            <label for="card-element">
                                {{ __('Credit Card') }}
                            </label>
                            <div id="card-element" class="form-control" ref="card">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors -->
                            <div id="card-errors" class="form-text text-muted" role="alert"></div>
                        </div>

                        <input type="submit" class="btn btn-primary" value="{{ __('Save billing details') }}">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-block">
                    <h4>{{ __('Current account overview') }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection