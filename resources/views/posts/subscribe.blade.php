@extends('layouts.app')

@section('content')
    <div class="container-fluid mx-auto create-post-wrapper">
        <h5>Let's subscribe!</h5>

        <form method="POST" action="{{route('posts.subscribe', ['post'=>$post])}}">
            @csrf
            <div class="field mx-auto">
                <input
                    type="text"
                    placeholder="email"
                    name="email"
                    class="{{$errors->first('email') ? 'border border-danger' : ''}}"
                    value="{{ $email }}"
                >
                @error('email')
                <p class="text-danger">{{ $errors->first('email') }}</p>
                @enderror
            </div>
            <input type="submit" name="Submit">
        </form>
        @if(session('message'))
            <p class="alert-info">{{session('message')}}</p>
        @endif
    </div>
@endsection
