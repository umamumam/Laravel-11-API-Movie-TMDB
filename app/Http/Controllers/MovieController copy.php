<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        // Ambil API Key dari .env
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function index()
    {
        // Ambil parameter query dari request
        $query = request()->query('search');
        $genre = request()->query('genre');
        $country = request()->query('country');
        $year = request()->query('year');
        $rating = request()->query('rating');
        $mediaType = request()->query('media_type', 'movie'); // default to 'movie'
        $type = request()->query('type', 'now_playing'); // default to 'now_playing'

        // Tentukan URL berdasarkan tipe media (movie / tv)
        if ($mediaType === 'movie') {
            // Movie URLs
            switch ($type) {
                case 'now_playing':
                    $url = "https://api.themoviedb.org/3/movie/now_playing";
                    break;
                case 'upcoming':
                    $url = "https://api.themoviedb.org/3/movie/upcoming";
                    break;
                case 'top_rated':
                    $url = "https://api.themoviedb.org/3/movie/top_rated";
                    break;
                case 'popular':
                    $url = "https://api.themoviedb.org/3/movie/popular";
                    break;
                default:
                    $url = "https://api.themoviedb.org/3/movie/now_playing";
            }
        } elseif ($mediaType === 'tv') {
            // TV URLs
            switch ($type) {
                case 'airing_today':
                    $url = "https://api.themoviedb.org/3/tv/airing_today";
                    break;
                case 'on_the_air':
                    $url = "https://api.themoviedb.org/3/tv/on_the_air";
                    break;
                case 'top_rated':
                    $url = "https://api.themoviedb.org/3/tv/top_rated";
                    break;
                case 'popular':
                    $url = "https://api.themoviedb.org/3/tv/popular";
                    break;
                default:
                    $url = "https://api.themoviedb.org/3/tv/airing_today";
            }
        }

        // Param untuk API call
        $params = [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => 1
        ];

        // Jika ada pencarian, override URL dan tambahkan query pencarian
        if ($query) {
            $url = "https://api.themoviedb.org/3/search/" . $mediaType;
            $params['query'] = $query;
        }

        // Menambahkan filter berdasarkan genre, negara, tahun
        if ($genre) {
            $params['with_genres'] = $genre;
        }

        // Kode khusus untuk negara:
        if ($country) {
            switch (strtolower($country)) {
                case 'jp': // Jepang
                    $params['with_origin_country'] = '14,963';
                    break;
                case 'id': // Indonesia
                    $params['with_origin_country'] = '430';
                    break;
                case 'us': // Inggris
                    $params['with_origin_country'] = '77,198';
                    break;
            }
        }

        if ($year) {
            if ($mediaType === 'tv') {
                $params['first_air_date_year'] = $year; // Untuk TV Shows
            } else {
                $params['primary_release_year'] = $year; // Untuk Movies
            }
        }

        // Ambil data dari API berdasarkan media type dan filters
        $response = Http::get($url, $params);
        $results = $response->json()['results'] ?? [];

        // Filter berdasarkan rating jika ada
        if ($rating) {
            $results = array_filter($results, function ($result) use ($rating) {
                return $result['vote_average'] >= $rating;
            });
        }

        // Kirim data ke view movies.index atau tv.index
        if ($mediaType === 'movie') {
            return view('movies.index', compact('results', 'mediaType', 'type'));
        } else {
            return view('tv.index', compact('results', 'mediaType', 'type'));
        }
    }

    public function show($id)
    {
        // Mengambil detail film
        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        $movie = $response->json();

        // Mengambil trailer film
        $trailerResponse = Http::get("https://api.themoviedb.org/3/movie/{$id}/videos", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        $trailers = $trailerResponse->json()['results'];
        $youtubeTrailer = '';

        foreach ($trailers as $trailer) {
            if ($trailer['site'] == 'YouTube' && $trailer['type'] == 'Trailer') {
                $youtubeTrailer = 'https://www.youtube.com/embed/' . $trailer['key'];
                break;
            }
        }

        // Mengambil rekomendasi film
        $recommendationsResponse = Http::get("https://api.themoviedb.org/3/movie/{$id}/recommendations", [
            'api_key' => $this->apiKey,
            'language' => 'en-US'
        ]);

        $recommendations = $recommendationsResponse->json()['results'];

        return view('movies.show', compact('movie', 'youtubeTrailer', 'recommendations'));
    }
}
