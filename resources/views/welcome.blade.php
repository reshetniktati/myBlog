@extends('layouts.app')

@section('content')

    <div>
        <h1>My blog</h1>
        <span>read & write whatever you want</span>
    </div>
    <div>
        <h4>recently added</h4>
        <div>
            @foreach($posts as $post)
                <p>{{$post->title}}</p>
            @endforeach
        </div>
        @if(Auth::check())
            <a href="/posts">see all</a>
        @else
            Login/register to see more!
        @endif
    </div>

@endsection
