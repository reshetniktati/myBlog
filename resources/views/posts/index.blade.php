@extends('layouts.app')

@section('content')
    <div>
        <div class="container">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="card">
                        <a href="{{route('posts.show', ['id'=>$post->id])}}" class="card-header">{{ $post->title }}</a>
                        <p class="card-body">{{ $post->body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{ $posts->links() }}

@endsection
