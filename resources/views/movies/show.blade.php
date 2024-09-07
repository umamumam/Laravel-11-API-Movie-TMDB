@extends('layouts.app')

@section('title', $movie['title'])

@section('content')
<div class="movie-detail" style="background: url('https://image.tmdb.org/t/p/original{{ $movie['backdrop_path'] }}') no-repeat center center; background-size: cover; padding: 40px 0; position: relative;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-8">
                <div class="bg-white bg-opacity-75 p-4 rounded shadow-sm">
                    <h1>{{ $movie['title'] }} <small class="text-muted">({{ date('Y', strtotime($movie['release_date'])) }})</small></h1>
                    <p class="mt-3">{{ $movie['overview'] }}</p>

                    <!-- Trailer -->
                    <h3 class="mt-4">Trailer</h3>
                    @if(isset($movie['videos']['results'][0]))
                        @php
                            $video = $movie['videos']['results'][0];
                            $src = "";
                            if (strpos($video['site'], 'YouTube') !== false) {
                                $src = "https://www.youtube.com/embed/{$video['key']}";
                            } elseif (strpos($video['site'], 'Vimeo') !== false) {
                                $src = "https://player.vimeo.com/video/{$video['key']}";
                            }
                            // Add more sources as needed
                        @endphp
                        @if($src)
                            <iframe width="100%" height="315" src="{{ $src }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                        @else
                            <p>No trailer available from supported sources.</p>
                        @endif
                    @else
                        <p>No trailer available.</p>
                    @endif
                    
                    <!-- Streaming Links -->
                    <h3 class="mt-4">Watch Online</h3>
                    @if(isset($providers['results']['US']['link']))
                        <a href="{{ $providers['results']['US']['link'] }}" class="btn btn-primary" target="_blank">Watch Movie</a>
                    @else
                        <p>No streaming link available.</p>
                    @endif

                    <!-- Streaming Video -->
                    <h3 class="mt-4">Watch Streaming</h3>
                    @if(isset($providers['results']['US']['flatrate']) && count($providers['results']['US']['flatrate']) > 0)
                        @foreach($providers['results']['US']['flatrate'] as $provider)
                            <h5>{{ $provider['provider_name'] }}</h5>
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $provider['provider_id'] }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                        @endforeach
                    @else
                        <p>No streaming video available.</p>
                    @endif

                    <!-- Cast -->
                    <h3 class="mt-4">Cast</h3>
                    @if(isset($movie['credits']['cast']) && count($movie['credits']['cast']) > 0)
                        <div class="row">
                            @foreach($movie['credits']['cast'] as $castMember)
                                @if($loop->index < 6) <!-- Limit to the first 6 cast members -->
                                    <div class="col-md-2 mb-3">
                                        <div class="card border-0 shadow-sm">
                                            <a href="#">
                                                <img src="https://image.tmdb.org/t/p/w500{{ $castMember['profile_path'] }}" alt="{{ $castMember['name'] }}" class="card-img-top rounded-circle">
                                            </a>
                                            <div class="card-body text-center">
                                                <p class="card-text">{{ $castMember['name'] }}</p>
                                                <p class="card-text text-muted">{{ $castMember['character'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p>No cast information available.</p>
                    @endif

                    <!-- Recommendations -->
                    <h3 class="mt-4">Recommendations</h3>
                    <div class="row">
                        @foreach($movie['recommendations']['results'] as $recommendation)
                            <div class="col-md-4 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <a href="{{ url('movies/' . $recommendation['id']) }}">
                                        <img src="https://image.tmdb.org/t/p/w500{{ $recommendation['poster_path'] }}" alt="{{ $recommendation['title'] }}" class="card-img-top rounded">
                                    </a>
                                    <div class="card-body text-center">
                                        <a href="{{ url('movies/' . $recommendation['id']) }}" class="stretched-link">{{ $recommendation['title'] }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
