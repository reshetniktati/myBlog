@extends('layouts.app')

@section('content')
    <div class="container-fluid mx-auto create-post-wrapper">
        <h5>Let's Create New Story!</h5>

        <form method="POST" action="/posts">
            @csrf
            <div class="field mx-auto">
                <input
                    type="text"
                    placeholder="Story name"
                    name="title"
                    class="{{$errors->first('title') ? 'bg-danger' : ''}}"
                    value="{{ old('title') }}"
                >
                @error('title')
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                @enderror
            </div>
            <div class="field mx-auto">
                <input
                    type="text"
                    placeholder="Describe main storyline"
                    name="teaser"
                >
            </div>
            <div class="field mx-auto">
                <textarea
                    cols="35" rows="5"
                    placeholder="Type story here"
                    name="body"
                    class="{{$errors->first('body') ? 'bg-danger' : ''}}"
                    value="{{ old('body') }}"
                ></textarea>
                @error('body')
                    <p class="text-danger">{{ $errors->first('body') }}</p>
                @enderror
            </div>
            <input type="submit" name="Submit">
        </form>
    </div>
@endsection
