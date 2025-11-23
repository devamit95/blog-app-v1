@extends('layouts.app')
@section('title', 'Posts')
@section('content')
    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                        <p class="card-text text-muted">By {{ $post->user->name }} • {{ $post->created_at->format('d-m-Y h:i A') }} • Comments - {{ $post->comments->count() }}</p>
                        <p class="card-text">{{ Str::limit($post->content, 200) }}</p>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-primary">Read</a>
                    </div>
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Recent posts</div>
                <div class="card-body">
                    @if ($recentPosts->count() > 0)
                        @foreach($recentPosts as $r)
                            <div><a href="{{ route('posts.show', $r) }}">{{ $r->title }}</a></div>
                        @endforeach
                    @else
                        <h6>No post found</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
