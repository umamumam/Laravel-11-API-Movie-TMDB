@extends('layouts.app')

@section('title', 'Top Rated Movies')

@section('content')
    <h1>Top Rated Movies</h1>
    <div class="row">
        @foreach($movies as $movie)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie['title'] }}</h5>
                        <p class="card-text">{{ Str::limit($movie['overview'], 100) }}</p>
                    </div>
                    <div class="card-footer">
                      <a href="{{ url('movies/' . $movie['id']) }}" class="btn btn-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
