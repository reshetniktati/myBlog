@component('mail::message')
# Hello, {{$subscriber}}!!!

<br>
<h5>You've been subscribed to {{$author}}! Congrats!!!</h5>

<p>For now and on you'll me subscribed to {{$author}}, don't miss any news =)</p>

@component('mail::button', ['url' => route('posts.index')])
    Back Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
