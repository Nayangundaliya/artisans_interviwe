@component('mail::message')
# {{ $emailData['subject'] }}

{{ $emailData['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent