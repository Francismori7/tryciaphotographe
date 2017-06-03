@extends('layouts.app')

@section('content')
    <h1>Dashboard
        <small class="text-muted">@yield('title')</small>
    </h1>
    <hr>

    <div class="row">
        <div class="col-md">
            <nav class="nav flex-lg-column nav-pills nav-fill">
                <a class="nav-link {{ $currentDashboardPage === 'home' ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <i class="fa fa-home fa-fw" aria-hidden="true"></i> {{ __('Home') }}
                </a>
                <a class="nav-link {{ $currentDashboardPage === 'notifications' ? 'active' : '' }}" href="{{ route('dashboard.notifications.index') }}">
                    <i class="fa fa-bell-o fa-fw" aria-hidden="true"></i> {{ __('Notifications') }}
                </a>
                <a class="nav-link {{ $currentDashboardPage === 'billing' ? 'active' : '' }}" href="{{ route('dashboard.billing.index') }}">
                    <i class="fa fa-credit-card fa-fw" aria-hidden="true"></i> {{ __('Billing') }}
                </a>
                <a class="nav-link {{ $currentDashboardPage === 'settings' ? 'active' : '' }}" href="#">
                    <i class="fa fa-cogs fa-fw" aria-hidden="true"></i> {{ __('Settings') }}
                </a>
            </nav>
        </div>
        <div class="col-md-10">
            @yield('dashboard-page')
        </div>
    </div>
@endsection