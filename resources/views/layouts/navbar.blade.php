<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link"href="{{ route('genre.create') }}">Thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.create') }}">Danh mục phim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('country.create') }}">Quốc gia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movie.create') }}">Phim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('episode.create') }}">Tập phim</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2 " type="search" placeholder="..." aria-label="Search">
                <button class="btn btn-outline-success w-100" type="submit">Tìm kiếm phim</button>
            </form>
        </div>
    </div>
</nav>
