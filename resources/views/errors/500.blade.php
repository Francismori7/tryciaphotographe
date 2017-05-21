@extends('layouts.app')

@section('title', __('Internal Server Error'))

@section('content')
    <h1 class="display-1">
        500
        <small class="text-muted">{{ __('Internal Server Error') }}</small>
    </h1>

    <p class="lead">{{ __('The server encountered an error and could not process your request.') }}</p>

    <p>
        <strong>{{ __('This is not your fault.') }}</strong>
        {{ __('We have been notified of the issue and we are already taking a look at it.') }}
        {{ __('You may proceed with your request and ignore this message.') }}
    </p>

    <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg">{{ __('Go back') }}</a>
@endsection