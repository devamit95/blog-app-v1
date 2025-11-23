@extends('layouts.app')
@section('content')
    <h3>Edit Post</h3>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @method('PUT')
        @include('posts.form', ['buttonText' => 'Update'])
    </form>
@endsection
