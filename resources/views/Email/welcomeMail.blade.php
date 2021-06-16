@component('mail::message')
Payment Confirmation

The payment your product: {{$mailInfo['description']}} was successful. 



Thanks,<br>
{{ config('app.name') }}
@endcomponent
