@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <hr>

    <p>{{$post->body}}</p>
    @can('update', $post)
        <a href="{{route('posts.edit', ['id'=>$post->id])}}">update the post</a>
    @endcan
@endsection

