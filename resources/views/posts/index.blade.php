@extends('layouts.app')

@section('content')
    <div>
        <div class="container">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="card my-4">
                        <a href="{{ route('posts.show', ['post'=>$post]) }}" class="card-header">{{ $post->title }}</a>
                        <div class="card-body">
                            <span class="text-monospace text-muted">author: {{ $post->user->name }}</span>
                            <p class="card-body">{{ $post->body }}</p>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{ $posts->links() }}

@endsection
