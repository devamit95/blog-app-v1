@extends('layouts.app')
@section('content')
    <h3>Create Post</h3>
    <form action="{{ route('posts.store') }}" method="POST">
        @include('posts.form', ['buttonText' => 'Create'])
    </form>
@endsection
