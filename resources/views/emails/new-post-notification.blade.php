@component('mail::message')
# Hello, {{$subscriber->name}}!!!

<br>

<p>There is something new from {{$author->name}}</p>

@component('mail::button', ['url' => route('posts.index')])
    See all
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
