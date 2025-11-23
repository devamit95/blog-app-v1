@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Users</h3>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                @if (auth()->user()->id !== $user->id)
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete user?')">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($users->hasPages())
            <div class="card-footer bg-light">
                {{ $users->links('pagination::admin') }}
            </div>
        @endif
    </div>
@endsection
