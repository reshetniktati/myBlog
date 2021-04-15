@extends('layouts.app')

@section('content')

    <div class="container-fluid mx-auto pb-4" style="width: 300px; color: red;">
        <h1 style="font-size: 50px; font-weight: 900">My blog</h1>
        <span>read & write whatever you want</span>
    </div>
    <div>
        <p style="font-size: 18px; color: #727272">recently added:</p>
        <div>
            @foreach($posts as $post)
                <h3>{{$post->title}}</h3>
                <hr>
            @endforeach
        </div>
        <div style="color: red;">
            @if(Auth::check())
                <a href="/posts">see all</a>
            @else
                <p>Login/register to see more!</p>
            @endif
        </div>
    </div>

@endsection
