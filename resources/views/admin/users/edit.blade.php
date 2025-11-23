@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <h3>Edit User</h3>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="mt-3">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
