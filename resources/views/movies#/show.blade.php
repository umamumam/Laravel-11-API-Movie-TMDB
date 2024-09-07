<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $movie['title'] }}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1 {
      font-weight: 700;
      margin-bottom: 1rem;
      color: #343a40;
    }

    p {
      font-size: 1rem;
      color: #6c757d;
    }

    .movie-info {
      background-color: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .movie-info h1 {
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
    }

    .movie-info p {
      margin-bottom: 1rem;
    }

    .movie-info strong {
      color: #495057;
    }

    .img-fluid {
      border-radius: 0.5rem;
    }

    .btn-primary {
      background-color: #0069d9;
      border-color: #0069d9;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .movie-details {
      font-size: 1.1rem;
      color: #495057;
    }

    .movie-poster-container {
      margin-bottom: 2rem;
      transition: transform 0.3s ease;
    }

    .movie-poster-container:hover {
      transform: scale(1.05);
    }

    /* Modal Styling */
    .modal-content {
      border-radius: 0.75rem;
    }

    .modal-body {
      padding: 0;
      background-color: #000;
    }

    /* Responsive iframe in modal */
    .modal-body iframe {
      width: 100%;
      height: 60vh;
      /* 60% of the viewport height */
      border-radius: 0 0 0.75rem 0.75rem;
    }

    .card {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-img-top {
      height: 350px;
      object-fit: cover;
      border-radius: 0.5rem 0.5rem 0 0;
    }

    .card-body {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .card-title {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .card-text {
      flex-grow: 1;
      font-size: 0.9rem;
      color: #6c757d;
    }

    .btn-primary {
      margin-top: 1rem;
    }


    @media (min-width: 768px) {
      .modal-dialog {
        max-width: 800px;
        /* Set maximum width of the modal */
      }
    }

    @media (max-width: 768px) {
      .movie-info {
        padding: 1.5rem;
      }

      .movie-info h1 {
        font-size: 2rem;
      }

      .movie-info p {
        font-size: 0.9rem;
      }

      .modal-body iframe {
        height: 50vh;
        /* For smaller screens, adjust height */
      }
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="img-fluid"
          alt="{{ $movie['title'] }}">
      </div>
      <div class="col-md-8">
        <div class="movie-info">
          <h1>{{ $movie['title'] }}</h1>
          <p>{{ $movie['overview'] }}</p>
          <p><strong>Release Date:</strong> {{ $movie['release_date'] }}</p>
          <p><strong>Rating:</strong> {{ $movie['vote_average'] }}/10</p>
          <p><strong>Duration:</strong> {{ $movie['runtime'] }} minutes</p>

          <!-- Play Trailer Button -->
          @if($youtubeTrailer)
          <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#trailerModal">Play
            Trailer</button>
          @endif

          <a href="/movies" class="btn btn-secondary mt-3">Back to Movies</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Trailer -->
  <div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="trailerModalLabel">Watch Trailer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if($youtubeTrailer)
          <iframe src="{{ $youtubeTrailer }}" frameborder="0" allowfullscreen></iframe>
          @else
          <p>Trailer is not available.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  @if(count($recommendations) > 0)
  <div class="container mt-5">
    <h2 class="text-center">Recommended Movies</h2>
    <div class="row">
      @foreach($recommendations as $rec)
      <div class="col-md-3 mb-4">
        <div class="card shadow-sm">
          <img src="https://image.tmdb.org/t/p/w500{{ $rec['poster_path'] }}" class="card-img-top"
            alt="{{ $rec['title'] }}">
          <div class="card-body">
            <h5 class="card-title">{{ $rec['title'] }}</h5>
            <p class="card-text">{{ Str::limit($rec['overview'], 80) }}</p>
            <a href="{{ route('movies.show', $rec['id']) }}" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>