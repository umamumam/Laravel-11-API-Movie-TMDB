<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TMDB App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Navbar gradasi dan styling */
        .navbar {
            background: linear-gradient(90deg, rgba(52,58,64,1) 0%, rgba(253,187,45,1) 100%);
            color: white;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700 !important;
        }

        html {
            height: 100%;
            box-sizing: border-box;
        }

        /* Footer styling */
        footer {
            flex-shrink: 0; /* Prevents the footer from shrinking */
            background-color: #343a40;
            color: #fff;
            padding: 30px 0;
        }

        footer a {
            color: #ffd700;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Body background */
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            min-height: 100vh; /* Use the viewport height */
        }

        .container {
            flex: 1 0 auto; /* Ensures that the container can expand to fill available space */
        }

        /* Button styling */
        .btn-custom {
            background-color: #ffd700;
            color: #000;
            border: none;
        }

        .btn-custom:hover {
            background-color: #ffc107;
            color: #fff;
        }

        /* Content styling */
        h1, h2, h3 {
            color: #343a40;
        }

        .content-header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        /* Additional card styling */
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 400px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            flex-grow: 1;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 0.75rem;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .card-footer {
            padding: 10px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/movies">
                <i class="fas fa-film"></i> Filmku
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="moviesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Movies
                        </a>
                        <div class="dropdown-menu" aria-labelledby="moviesDropdown">
                            <a class="dropdown-item" href="{{ url('/movies') }}">All Movies</a>
                            <a class="dropdown-item" href="{{ url('/movies/now-playing') }}">Now Playing</a>
                            <a class="dropdown-item" href="{{ url('/movies/upcoming') }}">Upcoming</a>
                            <a class="dropdown-item" href="{{ url('/movies/top-rated') }}">Top Rated</a>
                            <a class="dropdown-item" href="{{ url('/search/movies') }}">Search Movies</a>
                        </div>
                    </li>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ url('/tv/top-rated') }}" id="tvDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TV Shows
                        </a>
                        <div class="dropdown-menu" aria-labelledby="tvDropdown">
                            <a class="dropdown-item" href="{{ url('/tv') }}">All TV</a>
                            <a class="dropdown-item" href="{{ url('/tv/airing-today') }}">Airing Today</a>
                            <a class="dropdown-item" href="{{ url('/tv/on-the-air') }}">Currently Airing TV Shows</a>
                            <a class="dropdown-item" href="{{ url('/tv/top-rated') }}">Anime</a>
                            <a class="dropdown-item" href="{{ url('/search/tv') }}">Search TV</a>
                        </div>
                    </li>                    
                    <li class="nav-item">
                        <form class="d-flex search-form" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="content-header text-center">
            <h1>@yield('title')</h1>
        </div>
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Filmku. All Rights Reserved. by Umam</p>
            <p>
                <a href="#"><i class="fab fa-facebook"></i> Facebook</a> | 
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a> | 
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.querySelector('.search-form');
            if (window.location.pathname.includes('/movies')) {
                searchForm.action = '{{ url('/search/movies') }}';
                searchForm.querySelector('input[type="search"]').placeholder = 'Search Movies';
            } else if (window.location.pathname.includes('/tv')) {
                searchForm.action = '{{ url('/search/tv') }}';
                searchForm.querySelector('input[type="search"]').placeholder = 'Search TV Shows';
            }
        });
    </script>
    
</body>
</html>
