@component('mail::message')
# {{ __('Way to go :user!', ['user' => $user->name]) }}

{{ __("Hey :user, you successfully activated your account. Way to go!", ['user' => $user->name]) }}

{{ __("Your account has been unlocked! Feel free to try out product out!") }}

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent