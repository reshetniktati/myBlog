@extends('layouts.app');

@section('content')
    <users-grid
        :users='@json($users)'
    ></users-grid>
@endsection
