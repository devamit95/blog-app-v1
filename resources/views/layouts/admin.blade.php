<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 220px;
            min-height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
        }

        .sidebar .nav-link {
            color: #333;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .pagination-sm .page-link {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="sidebar p-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}"
                    href="{{ route('admin.posts.index') }}">
                    Posts
                </a>
            </li>
            <li class="nav-item mt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger w-100">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="content">
        @include('partials.flash')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
