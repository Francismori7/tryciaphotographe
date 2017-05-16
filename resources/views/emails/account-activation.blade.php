@component('mail::message')
# {{ __('Welcome :user', ['user' => $user->name]) }}

{{ __("Hey :user, welcome to :app. Hang in there, you're almost set, we only need to verify your account so we can proceed.", ['user' => $user->name, 'app' => config('app.name')]) }}

@component('mail::button', ['url' => $user->activationPath()])
{{ __('Verify my account') }}
@endcomponent

{{ __("Until then, your account will not be accessible.") }}

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent