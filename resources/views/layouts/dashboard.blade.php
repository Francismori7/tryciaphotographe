@extends('layouts.app')

@section('content')
    <h1>Dashboard
        <small class="text-muted">@yield('title')</small>
    </h1>

    <div class="row">
        <div class="col-md">
            <nav class="nav flex-column">
                <a class="nav-link active" href="#">Active</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link disabled" href="#">Disabled</a>
            </nav>
        </div>
        <div class="col-md-10">
            @yield('dashboard-page')
        </div>
    </div>
@endsection