@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-md-10 col-sm-9 col-xs-12 offset-md-2 offset-sm-3">
            <h1>Dashboard
                <small class="text-muted">@yield('title')</small>
            </h1>
            <hr>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 hidden-xs-down px-0 sidebar">
                <nav class="nav flex-column nav-pills nav-fill">
                    <a class="nav-link {{ $currentDashboardPage === 'home' ? 'active' : '' }}"
                       href="{{ route('dashboard.index') }}">
                        <i class="fa fa-home fa-fw" aria-hidden="true"></i> {{ __('Home') }}
                    </a>
                    <a class="nav-link {{ $currentDashboardPage === 'notifications' ? 'active' : '' }} d-flex justify-content-between"
                       href="{{ route('dashboard.notifications.index') }}">
                        <div><i class="fa fa-bell-o fa-fw" aria-hidden="true"></i> {{ __('Notifications') }}</div>
                        <div><span class="badge badge-default badge-pill" :class="{'badge-danger': !!unreadNotifications}">@{{ unreadNotifications }}</span></div>
                    </a>
                    <a class="nav-link {{ $currentDashboardPage === 'billing' ? 'active' : '' }}"
                       href="{{ route('dashboard.billing.index') }}">
                        <i class="fa fa-credit-card fa-fw" aria-hidden="true"></i> {{ __('Billing') }}
                    </a>
                    <a class="nav-link {{ $currentDashboardPage === 'settings' ? 'active' : '' }}" href="#">
                        <i class="fa fa-cogs fa-fw" aria-hidden="true"></i> {{ __('Settings') }}
                    </a>
                </nav>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12 offset-md-2 offset-sm-3">
                @yield('dashboard-page')
            </div>
        </div>
    </div>
@endsection