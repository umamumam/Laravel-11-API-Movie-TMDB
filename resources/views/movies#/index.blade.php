<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nonton Film</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1 {
      font-weight: 700;
      margin-bottom: 2rem;
      color: #343a40;
    }

    .form-control,
    .form-select {
      border-radius: 0.5rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
      background-color: #0069d9;
      border-color: #0069d9;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    /* Styling card for better alignment and visuals */
    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
      border-radius: 1rem;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
      height: 300px;
      object-fit: cover;
    }

    .card-body {
      flex-grow: 1;
      padding: 1.5rem;
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

    .container {
      max-width: 1200px;
    }

    footer {
      background-color: #343a40;
      color: white;
      padding: 1rem 0;
      text-align: center;
      margin-top: 2rem;
    }

    .navbar-brand img {
      height: 50px;
    }

    .sticky-header {
      position: sticky;
      top: 0;
      z-index: 1020;
    }

    .hide-header {
      transform: translateY(-100%);
      transition: transform 0.3s ease-in-out;
    }

    .show-header {
      transform: translateY(0);
      transition: transform 0.3s ease-in-out;
    }

    .header-title {
      font-size: 1.8rem;
      font-weight: bold;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .mb-4 {
      margin-bottom: 2rem !important;
    }

  </style>
</head>

<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-header show-header">
    <div class="container-fluid">
      <a class="navbar-brand" href="/movies">
        <img src="Logo.png" alt="Logo">
        <span class="header-title">Cinema Now</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="navigateToCategory('now_playing')">Now Playing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="navigateToCategory('upcoming')">Upcoming Movies</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="navigateToCategory('popular')">Popular</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="navigateToCategory('on_tv')">On TV</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="navigateToCategory('tv_show')">TV Shows</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="navigateToCategory('anime')">Anime</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="navigateToCategory('indonesia')">Film Indonesia</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mt-5">
    <h1 class="text-center">
      @if($mediaType === 'movie')
        {{ $type === 'now_playing' ? 'Now Playing in Cinemas' : 'Movies' }}
      @else
        {{ $type === 'on_tv' ? 'On TV Today' : 'TV Shows' }}
      @endif
    </h1>

    <!-- Search Form -->
    <form action="{{ route('movies.index') }}" method="GET" class="mb-4">
      <div class="row">
        <!-- Search Box -->
        <div class="col-md-4 mb-3">
          <input type="text" name="search" class="form-control" placeholder="Search for a movie or TV show..." value="{{ request()->query('search') }}">
        </div>

        <!-- Genre Filter -->
        <div class="col-md-2 mb-3">
          <select name="genre" class="form-select">
            <option value="">All Genres</option>
            <option value="28" {{ request()->query('genre') == '28' ? 'selected' : '' }}>Action</option>
            <option value="12" {{ request()->query('genre') == '12' ? 'selected' : '' }}>Adventure</option>
            <option value="16" {{ request()->query('genre') == '16' ? 'selected' : '' }}>Animation</option>
            <option value="35" {{ request()->query('genre') == '35' ? 'selected' : '' }}>Comedy</option>
            <option value="18" {{ request()->query('genre') == '18' ? 'selected' : '' }}>Drama</option>
            <option value="AN" {{ request()->query('genre') == 'AN' ? 'selected' : '' }}>Anime</option>
          </select>
        </div>

        <!-- Country Filter -->
        <div class="col-md-2 mb-3">
          <select name="country" class="form-select">
            <option value="">All Countries</option>
            <option value="US" {{ request()->query('country') == 'US' ? 'selected' : '' }}>United States</option>
            <option value="GB" {{ request()->query('country') == 'GB' ? 'selected' : '' }}>United Kingdom</option>
            <option value="FR" {{ request()->query('country') == 'FR' ? 'selected' : '' }}>France</option>
            <option value="DE" {{ request()->query('country') == 'DE' ? 'selected' : '' }}>Germany</option>
            <option value="ID" {{ request()->query('country') == 'ID' ? 'selected' : '' }}>Indonesia</option>
            <option value="JP" {{ request()->query('country') == 'JP' ? 'selected' : '' }}>Japan</option>
            <option value="KR" {{ request()->query('country') == 'KR' ? 'selected' : '' }}>South Korea</option>
            <option value="CN" {{ request()->query('country') == 'CN' ? 'selected' : '' }}>China</option>
            <option value="IN" {{ request()->query('country') == 'IN' ? 'selected' : '' }}>India</option>
          </select>
        </div>

        <!-- Year Filter -->
        <div class="col-md-2 mb-3">
          <input type="number" name="year" class="form-control" placeholder="Year" min="1900" max="{{ date('Y') }}" value="{{ request()->query('year') }}">
        </div>

        <!-- Media Type Filter (Movies or TV Shows) -->
        <div class="col-md-2 mb-3">
          <select name="type" class="form-select">
            <option value="now_playing" {{ request()->query('type') == 'now_playing' ? 'selected' : '' }}>Now Playing</option>
            <option value="upcoming" {{ request()->query('type') == 'upcoming' ? 'selected' : '' }}>Upcoming Movies</option>
            <option value="on_tv" {{ request()->query('type') == 'on_tv' ? 'selected' : '' }}>On TV</option>
            <option value="top_rated" {{ request()->query('type') == 'top_rated' ? 'selected' : '' }}>Top Rated</option>
          </select>
        </div>

        <!-- Submit Button -->
        <div class="col-md-12 mb-3">
          <button class="btn btn-primary w-100" type="submit">Filter</button>
        </div>
      </div>
    </form>

    <!-- Movie/TV Show Cards -->
    <div class="row" id="movie-cards">
      @foreach($results as $result)
      <div class="col-md-3 mb-4 d-flex align-items-stretch">
          <div class="card shadow-sm">
              <img src="https://image.tmdb.org/t/p/w500{{ $result['poster_path'] }}" class="card-img-top"
                  alt="{{ $result['title'] ?? $result['name'] }}">
              <div class="card-body">
                  <h5 class="card-title">{{ $result['title'] ?? $result['name'] }}</h5>
                  <p class="card-text">{{ Str::limit($result['overview'], 100) }}</p>
                  <p class="card-text"><small class="text-muted">Release Date: {{ $result['release_date'] ?? $result['first_air_date'] }}</small></p>
              </div>
              <div class="card-footer">
                <a href="{{ route('movies.show', $result['id']) }}" class="btn btn-primary w-100">View Details</a>
              </div>
          </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2023 CinemaNow. All Rights Reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let lastScrollY = window.scrollY;
    const header = document.querySelector('.sticky-header');

    // Hide and Show Header on Scroll
    window.addEventListener('scroll', () => {
      if (window.scrollY > lastScrollY) {
        header.classList.add('hide-header');
      } else {
        header.classList.remove('hide-header');
      }
      lastScrollY = window.scrollY;
    });

    // Navigation to Category Function
    function navigateToCategory(category) {
      let baseUrl = '/'; // URL for category filtering can be handled by your back-end
      window.location.href = baseUrl + '?type=' + category;
    }
  </script>

</body>

</html>
