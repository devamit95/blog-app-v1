@extends('layouts.admin')

@section('title', 'Admin Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Posts</h3>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ optional($post->user)->name }}</td>
                            <td>
                                @if($post->trashed())
                                    <span class="badge bg-danger">Deleted</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                @if($post->trashed())
                                    <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete post?')">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($posts->hasPages())
            <div class="card-footer bg-light">
                {{ $posts->links('pagination::admin') }}
            </div>
        @endif
    </div>
@endsection
