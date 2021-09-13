@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    by <span>{{$post->user->name}}</span>
    @if(auth()->user()->id !== $post->user->id)
        <a href="{{route('subscribe.index', ['post'=>$post])}}" class="ml-4 text-info">Subscribe on this author</a>
    @endif
    <hr>

    <p>{{$post->body}}</p>
    @can('update', $post)
        <a href="{{route('posts.edit', ['post'=>$post])}}">update the post</a>
        <form method="POST" action="/posts/{{ $post->id }}" style="display: inline" ml-2>
            @csrf
            @method('DELETE')
            <button type="submit">Delete the post</button>
        </form>
    @endcan
@endsection

