<nav class="navbar navbar-expand-lg bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand text-light" href="{{ route('home') }}">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item ">
                    <a class="nav-link text-light active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-light"  href="{{route('blog.index')}}">Blog</a>
                </li>
                @if (!auth()->user())
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('login')}}">login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('register')}}">Daftar</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-light">Notifikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Akun {{ auth()->user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('logout')}}" class="nav-link text-light">Logout</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
