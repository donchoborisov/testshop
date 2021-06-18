@component('mail::message')
Deposit Payment Confirmation

 We successfully charge the Deposit payment for your product: {{$mailInfo['description']}}. 



Thanks,<br>
{{ config('app.name') }}
@endcomponent
