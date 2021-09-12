@component('mail::message')
# Hello, {{$subscriber->name}}!!!

<br>

<p>There is something new from {{$author->name}}</p>

@component('mail::button', ['url' => 'http://127.0.0.1:8000/posts'])
    See all
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
