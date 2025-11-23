@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
    <h3>Edit Post</h3>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="mt-3">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" rows="8" class="form-control" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" class="form-control" value="{{ optional($post->user)->name }}" disabled>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
