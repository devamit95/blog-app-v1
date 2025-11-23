<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Blog App</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    @if(!auth()->user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('posts.create') }}">New Post</a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
