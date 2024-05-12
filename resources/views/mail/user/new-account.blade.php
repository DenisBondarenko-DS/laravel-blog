@component('mail::message')
# You have registered in {{ config('app.name') }}

Your login: {{ $name }}

Your email: {{ $email }}
@endcomponent
