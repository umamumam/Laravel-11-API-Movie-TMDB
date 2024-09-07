@extends('layouts.app')

@section('title', $tvShow['name'])

@section('content')
<div class="tv-detail" style="background: url('https://image.tmdb.org/t/p/original{{ $tvShow['backdrop_path'] }}') no-repeat center center; background-size: cover; padding: 40px 0; position: relative;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <img src="https://image.tmdb.org/t/p/w500/{{ $tvShow['poster_path'] }}" alt="{{ $tvShow['name'] }}" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-8">
                <div class="bg-white bg-opacity-75 p-4 rounded shadow-sm">
                    <h1>{{ $tvShow['name'] }} <small class="text-muted">({{ date('Y', strtotime($tvShow['first_air_date'])) }})</small></h1>
                    <p class="mt-3">{{ $tvShow['overview'] }}</p>
                    
                    <!-- Trailer -->
                    <h3 class="mt-4">Trailer</h3>
                    @if(isset($tvShow['videos']['results'][0]))
                        @php
                            $video = $tvShow['videos']['results'][0];
                            $src = "";
                            if (strpos($video['site'], 'YouTube') !== false) {
                                $src = "https://www.youtube.com/embed/{$video['key']}";
                            } elseif (strpos($video['site'], 'Vimeo') !== false) {
                                $src = "https://player.vimeo.com/video/{$video['key']}";
                            }
                        @endphp
                        @if($src)
                            <iframe width="100%" height="315" src="{{ $src }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                        @else
                            <p>No trailer available from supported sources.</p>
                        @endif
                    @else
                        <p>No trailer available.</p>
                    @endif

                    <!-- Streaming Providers -->
                    <h3 class="mt-4">Streaming Providers</h3>
                    @if(isset($providers['results']['US']['flatrate']) && count($providers['results']['US']['flatrate']) > 0)
                        <div class="row">
                            @foreach($providers['results']['US']['flatrate'] as $provider)
                                <div class="col-md-2 mb-2">
                                    <div class="provider-card text-center">
                                        @if(isset($provider['logo_path']))
                                            <img src="https://image.tmdb.org/t/p/w500{{ $provider['logo_path'] }}" alt="{{ $provider['provider_name'] }}" class="img-fluid" style="max-width: 50px;">
                                        @endif
                                        <p class="mt-2">{{ $provider['provider_name'] }}</p>
                                        @if(isset($provider['link']))
                                            <a href="{{ $provider['link'] }}" class="btn btn-primary mt-2" target="_blank">Watch Now</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No streaming information available.</p>
                    @endif

                    <!-- Recommendations -->
                    <h3 class="mt-4">Recommendations</h3>
                    <div class="row">
                        @foreach($tvShow['recommendations']['results'] as $recommendation)
                            <div class="col-md-4 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <a href="{{ url('tv/' . $recommendation['id']) }}">
                                        <img src="https://image.tmdb.org/t/p/w500{{ $recommendation['poster_path'] }}" alt="{{ $recommendation['name'] }}" class="card-img-top rounded">
                                    </a>
                                    <div class="card-body text-center">
                                        <a href="{{ url('tv/' . $recommendation['id']) }}" class="stretched-link">{{ $recommendation['name'] }}</a>
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
