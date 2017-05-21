@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container">
        <h1 class="page-header">{{ __('Register an account') }}</h1>

        <div class="row">
            <div class="col-xs-12 col-md-4 push-md-8">
                <div class="card">
                    <div class="card-header">{{ __('I already have an account!') }}</div>
                    <div class="card-block">
                        <a href="{{ url('/login') }}" class="btn btn-info btn-block">
                            {{ __('Login') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 pull-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Create an account') }}</div>
                    <div class="card-block">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}

                            <div class="row form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="col-xs-12 col-md-3 col-form-label">{{ __('Name') }}</label>

                                <div class="col-xs-12 col-sm-9">
                                    <input type="text"
                                           class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}"
                                           name="name" value="{{ old('name') }}"
                                           placeholder="{{ __('Your name') }}">

                                    @if ($errors->has('name'))
                                        <small class="form-control-feedback">
                                            {{ $errors->first('name') }}
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="col-xs-12 col-md-3 col-form-label">E-Mail</label>

                                <div class="col-xs-12 col-sm-9">
                                    <input type="email"
                                           class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}"
                                           name="email"
                                           value="{{ old('email') }}" placeholder="E-Mail">

                                    @if ($errors->has('email'))
                                        <small class="form-control-feedback">
                                            {{ $errors->first('email') }}
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="col-xs-12 col-md-3 col-form-label">{{ __('Password') }}</label>

                                <div class="col-xs-12 col-sm-9">
                                    <input type="password"
                                           class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}"
                                           name="password"
                                           placeholder="{{ __('Password') }}">

                                    @if ($errors->has('password'))
                                        <small class="form-control-feedback">
                                            {{ $errors->first('password') }}
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                <label class="col-xs-12 col-md-3 col-form-label"></label>

                                <div class="col-xs-12 col-sm-9">
                                    <input type="password"
                                           class="form-control{{ $errors->has('password_confirmation') ? ' form-control-danger' : '' }}"
                                           name="password_confirmation"
                                           placeholder="{{ __('Password (confirmation)') }}">

                                    @if ($errors->has('password_confirmation'))
                                        <small class="form-control-feedback">
                                            {{ $errors->first('password_confirmation') }}
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="fa fa-user"></span> {{ __('Create my account') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection