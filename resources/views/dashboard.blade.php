@extends('layouts.app')
@section('title', 'My Posts')

@section('content')
    <div class="row">
        @if ($posts->count() > 0)
            @foreach($posts as $post)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h5>
                            <p class="card-text text-muted">{{ $post->created_at->format('d-m-Y h:i:s A') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card mb-3">
                <div class="card-body text-md-center">
                    <h5 class="card-title">No post found</h5>
                </div>
            </div>
        @endif

        {{ $posts->links() }}
    </div>
@endsection
