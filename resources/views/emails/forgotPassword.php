@component('mail::message')
# Hi, {{ $user->name }},

Click the below link to reset the password!


@component('mail::button', ['url' => $link])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
