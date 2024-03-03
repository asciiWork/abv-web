@component('mail::message')
# Hi

<p> You have received new inquiry. </p>

<p> <span>Name: <b>{{$contact->firstname}} {{$contact->lastname}}</b></span> </p>
<p> <span>Email: <b>{{$contact->email}}</b></span> </p>
<p> <span>Phone: <b>{{$contact->phone_number}}</b></span> </p>
<p> <span>Message: <b>{{$contact->message}}</b></span> </p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent