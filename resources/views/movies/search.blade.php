@extends('layouts.app')

@section('title', 'Search Movies')

@section('content')
<form action="{{ url('search') }}" method="GET" class="mb-4">
    <div class="row g-3 align-items-end">
        <div class="col-md-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter movie name" value="{{ request('name') }}">
        </div>
        <div class="col-md-2">
            <label for="year" class="form-label">Year</label>
            <input type="number" id="year" name="year" class="form-control" placeholder="Enter year" value="{{ request('year') }}">
        </div>
        <div class="col-md-3">
            <label for="country" class="form-label">Country</label>
            <select name="country" id="country" class="form-select">
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
        <div class="col-md-3">
            <label for="genre" class="form-label">Genre</label>
            <select name="genre" id="genre" class="form-select">
                <option value="">All Genres</option>
                <option value="28" {{ request()->query('genre') == '28' ? 'selected' : '' }}>Action</option>
                <option value="12" {{ request()->query('genre') == '12' ? 'selected' : '' }}>Adventure</option>
                <option value="16" {{ request()->query('genre') == '16' ? 'selected' : '' }}>Animation</option>
                <option value="35" {{ request()->query('genre') == '35' ? 'selected' : '' }}>Comedy</option>
                <option value="18" {{ request()->query('genre') == '18' ? 'selected' : '' }}>Drama</option>
                <option value="AN" {{ request()->query('genre') == 'AN' ? 'selected' : '' }}>Anime</option>
            </select>
        </div>
        <div class="col-md-1 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
<hr>
    <h1>Search Results</h1>
    @if(!empty($results))
        <div class="row">
            @foreach($results as $movie)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] ?? 'default_image.jpg' }}" class="card-img-top" alt="{{ $movie['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie['title'] }}</h5>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('movies/' . $movie['id']) }}" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            No results found.
        </div>
    @endif
@endsection
