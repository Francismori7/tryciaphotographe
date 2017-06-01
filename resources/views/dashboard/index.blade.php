@extends('layouts.dashboard')

@section('title', __('Accueil'))

@section('dashboard-page')
    <div class="card-deck">
        @foreach($user->connectedAccounts as $account)
            <div class="card">
                <div class="card-header">
                    <i class="fa {{ $account->getIcon() }}"></i>
                    {{ $account->getName() }}
                </div>
                <div class="card-block">
                    {{ $account->account_id }}

                    {{--{{ $account->getInstance()->refreshAccount() }}--}}

                    <img class="img-fluid rounded" src="{{ $account->data->avatar }}" alt="">
                </div>
            </div>
        @endforeach
    </div>
@endsection