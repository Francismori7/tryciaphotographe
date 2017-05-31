@extends('layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="container">
        <h1 class="page-header">{{ __('Login to your account') }}</h1>

        <div class="row">
            <div class="col-xs-12 col-md-4 push-md-8">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Proceed with social authentification') }}</div>
                    <div class="card-block">
                        <a href="#" class="btn btn-facebook btn-block">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i> {{ __('Sign in with Facebook') }}
                        </a>
                        <a href="{{ route('google.redirect') }}" class="btn btn-google btn-block">
                            <i class="fa fa-google" aria-hidden="true"></i> {{ __('Sign in with Google') }}
                        </a>
                        <a href="#" class="btn btn-twitter btn-block">
                            <i class="fa fa-twitter" aria-hidden="true"></i> {{ __('Sign in with Twitter') }}
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('I do not have an account!') }}</div>
                    <div class="card-block">
                        <a href="{{ url('/register') }}" class="btn btn-success btn-block">
                            {{ __('Create a new account') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 pull-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Login to your account') }}</div>
                    <div class="card-block">
                        <form class="form-horizontal" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="row form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="col-xs-12 col-md-3 col-form-label"
                                       for="email">{{ __('Email address') }}</label>

                                <div class="col-xs-12 col-md-9">
                                    <input type="email"
                                           class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}"
                                           name="email" value="{{ old('email') }}"
                                           id="email"
                                           placeholder="{{ __('Your email address') }}">

                                    @if ($errors->has('email'))
                                        <small class="form-control-feedback">
                                            {{ $errors->first('email') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="col-xs-12 col-md-3 col-form-label"
                                       for="password">{{ __('Password') }}</label>

                                <div class="col-xs-12 col-md-9">
                                    <input type="password"
                                           class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}"
                                           name="password" value="{{ old('password') }}"
                                           id="password"
                                           placeholder="{{ __('Your password') }}">

                                    @if ($errors->has('password'))
                                        <small class="form-control-feedback">
                                            {{ $errors->first('password') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-9 offset-md-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-9 offset-md-3">
                                    <div class="form-check">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
