@extends('layouts.app')

@section('title', __('Forbidden'))

@section('content')
    <h1 class="display-1">
        403
        <small class="text-muted">{{ __('Forbidden') }}</small>
    </h1>

    <p class="lead">{{ __('Your user account currently does not allow you to proceed with this request.') }}</p>

    <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg">{{ __('Go back') }}</a>
@endsection