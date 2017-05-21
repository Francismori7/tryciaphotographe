@extends('layouts.app')

@section('title', __('Not Found'))

@section('content')
    <h1 class="display-1">
        404
        <small class="text-muted">{{ __('Not Found') }}</small>
    </h1>

    <p class="lead">{{ __('The current page does not exist.') }}</p>

    <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg">{{ __('Go back') }}</a>
@endsection