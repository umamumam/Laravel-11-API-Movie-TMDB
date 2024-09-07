@extends('layouts.app')

@section('title', 'Popular TV Shows')

@section('content')
    <h1>Popular TV Shows</h1>
    <div class="row">
        @foreach($tvShows as $tvShow)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://image.tmdb.org/t/p/w500/{{ $tvShow['poster_path'] }}" class="card-img-top" alt="{{ $tvShow['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tvShow['name'] }}</h5>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('tv/' . $tvShow['id']) }}" class="btn btn-primary w-100">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
