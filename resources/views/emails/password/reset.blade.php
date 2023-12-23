@component('mail::message')
# Reset password

Dear {{$name}},

Please click the below link to reset your password.
Hope you have a nice day.

@component('mail::button', ['url' => $url])
Reset
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent