@component('mail::message')
# Please activate your account

Dear {{$name}},

Thanks to register our service, please click the below to activate your account.
Hope you have a nice day.

@component('mail::button', ['url' => $url])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent