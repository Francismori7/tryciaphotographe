@extends('layouts.app')

@section('title', __('Users'))

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-block">
                <h1>{{ __('Users') }}</h1>
                <p class="lead">{{ __('Manage all registered users here.') }}</p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary">
                            <div class="card-block lead text-center text-white">
                                {{ $totalUsers }} users
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info">
                            <div class="card-block lead text-center text-white">
                                {{ $weeklyNewUsers }} new users this week
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success">
                            <div class="card-block lead text-center text-white">
                                {{ $totalActivatedUsers }} activated users
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md col-sm-12">
                        <form action="{{ route('admin.users.index') }}" class="form-inline">
                            <input type="text" class="form-control form-control"
                                   name="search" placeholder="{{ __('Search...') }}"
                                   value="{{ request()->query('search') }}">

                            <button class="btn btn-primary ml-2">Search</button>
                            @if(request()->query('search'))
                                <a href="{{ route('admin.users.index') }}" class="btn btn-danger ml-2"><i class="fa fa-times" aria-hidden="true"></i></a>
                                @endif
                        </form>
                    </div>
                    <div class="col-md col-sm-12 text-sm-left text-md-right">
                        <a href="#" class="btn btn-link">{{ __('Contact everyone') }}</a>
                        @can('create users')
                            <a href="{{ route('admin.users.create') }}"
                               class="btn btn-primary">{{ __('Create a user') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <table class="table table-responsive table-hover table-striped">
                            <thead>
                            <tr>
                                <td>{{ __('#') }}</td>
                                <td width="100%">{{ __('Name') }}</td>
                                <td>{{ __('Email') }}</td>
                                <td>{{ __('Timestamps') }}</td>
                                <td>{{ __('Options') }}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td nowrap>{{ $user->id }}</td>
                                    <td>
                                        @can('view all users')
                                            <a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a>
                                        @elsecan
                                            {{ $user->name }}
                                        @endcan
                                    </td>
                                    <td nowrap>{{ $user->email }}</td>
                                    <td nowrap>
                                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>{{ $user->created_at }}
                                        @if($user->created_at->ne($user->updated_at))
                                            <br>
                                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>{{ $user->updated_at }}
                                        @endif
                                    </td>
                                    <td nowrap>
                                        @can('view all users')
                                            <a href="{{ route('admin.users.show', $user) }}"
                                               class="btn btn-link btn-sm">{{ __('Show') }}</a>
                                        @endcan
                                        @can('edit users')
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                        @endcan
                                        @can('delete users')
                                            <a href="{{ route('admin.users.destroy', $user) }}"
                                               class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        {{ $users->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection