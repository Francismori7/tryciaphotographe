@extends('layouts.dashboard')

@section('title', __('Notifications'))

@section('dashboard-page')
    <p class="lead">{{ __('Anytime something important happens regarding your account, a notification will be sent here.') }}</p>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-block">
                    <div class="row mb-4">
                        <div class="col-md">
                            {{ $user->notifications->links() }}
                        </div>
                        <div class="col-md text-md-right">
                            <a href="{{ route('dashboard.notifications.destroyAll') }}" class="btn btn-outline-primary">Mark
                                all as read</a>
                        </div>
                    </div>

                    <notifications inline-template>
                        <div class="list-group mb-3">
                            @forelse($user->notifications as $notification)
                                <a href="{{ $notification->data['link'] }}"
                                   @click="readNotification('{{ $notification->id }}', {{ $notification->unread() ? 'true' : 'false' }})"
                                   class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $notification->data['title'] }}</h5>
                                        <small>
                                            @if($notification->unread())
                                                <i class="fa fa-bell text-danger" aria-hidden="true"></i>
                                            @endif
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p class="mb-1">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <small>{{ $notification->data['small'] }}</small>
                                </a>
                            @empty
                                {{ __('You have not received any notifications yet.') }}
                            @endforelse
                        </div>
                    </notifications>
                </div>
            </div>
        </div>
    </div>
@endsection