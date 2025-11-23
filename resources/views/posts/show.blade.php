@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h2>{{ $post->title }}</h2>
            <p class="text-muted">By {{ $post->user->name }} • {{ $post->created_at->format('d M Y') }}</p>
            <div class="mt-3">{!! nl2br(e($post->content)) !!}</div>

            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary mt-3">Edit</a>
            @endcan
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger mt-3">Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Comments</h5>
            @if (empty($post->comments) || count($post->comments) == 0)
                <p>No comments yet.</p>
            @else
                @foreach($post->comments as $comment)
                    <div class="border p-2 mb-2">
                        <strong>{{ $comment->user->name }}</strong>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        <p class="mb-0">{{ $comment->content }}</p>
                    </div>
                @endforeach
            @endif

            @auth
                <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button class="btn btn-primary">Add Comment</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">Login</a> to comment.</p>
            @endauth
        </div>
    </div>
@endsection
