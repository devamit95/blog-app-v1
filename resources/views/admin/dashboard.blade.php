@extends('layouts.admin')

@section('content')
    <h3>Dashboard</h3>
    <div class="row my-4">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Users</h5>
                <p class="display-6">{{ $stats['users'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Posts</h5>
                <p class="display-6">{{ $stats['posts'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Comments</h5>
                <p class="display-6">{{ $stats['comments'] }}</p>
            </div>
        </div>
    </div>
@endsection
