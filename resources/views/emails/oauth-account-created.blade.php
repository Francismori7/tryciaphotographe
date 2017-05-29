@component('mail::message')
# {{ __('Way to go :user!', ['user' => $user->name]) }}

{{ __("Hey :user, you successfully created your account using a social provider. Way to go!", ['user' => $user->name]) }}

{{ __("Your account is already unlocked! Feel free to try out product out!") }}

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent