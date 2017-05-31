<div class="card mb-4">
    <div class="card-header">{{ __('Proceed with social authentification') }}</div>
    <div class="card-block">
        <a href="{{ route('facebook.redirect') }}" class="btn btn-facebook btn-block">
            <i class="fa {{ \App\FacebookAccount::$icon }}" aria-hidden="true"></i> {{ __('Sign in with Facebook') }}
        </a>
        <a href="{{ route('google.redirect') }}" class="btn btn-google btn-block">
            <i class="fa {{ \App\GoogleAccount::$icon }}" aria-hidden="true"></i> {{ __('Sign in with Google') }}
        </a>
        <a href="{{ route('twitter.redirect') }}" class="btn btn-twitter btn-block">
            <i class="fa {{ \App\TwitterAccount::$icon }}" aria-hidden="true"></i> {{ __('Sign in with Twitter') }}
        </a>
    </div>
</div>