@component('mail::message')
    Hello {{ $user->name }},
    <br>
    You are receiving this email because we received a password reset request for your account.
    <br>
    @component('mail::button' , ['url' => url('/reset-password', $user->remember_token)])
        Reset Password
    @endcomponent
    If you did not request a password reset, no further action is required.
    <br>
    Regards,
    <br>
    {{ config('app.name') }}
@endcomponent

