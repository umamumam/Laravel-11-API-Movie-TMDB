<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MovieController extends Controller
{
    private $client;
    private $api_key;

    public function __construct()
    {
        $this->client = new Client();
        $this->api_key = env('TMDB_API_KEY');
    }

    public function index()
    {
        $response = $this->client->get("https://api.themoviedb.org/3/movie/popular?api_key={$this->api_key}");
        $movies = json_decode($response->getBody(), true);
        return view('movies.index', ['movies' => $movies['results']]);
    }

    public function nowPlaying()
    {
        $response = $this->client->get("https://api.themoviedb.org/3/movie/now_playing?api_key={$this->api_key}");
        $movies = json_decode($response->getBody(), true);
        return view('movies.now_playing', ['movies' => $movies['results']]);
    }

    public function upcoming()
    {
        $response = $this->client->get("https://api.themoviedb.org/3/movie/upcoming?api_key={$this->api_key}");
        $movies = json_decode($response->getBody(), true);
        return view('movies.upcoming', ['movies' => $movies['results']]);
    }

    public function topRated()
    {
        $response = $this->client->get("https://api.themoviedb.org/3/movie/top_rated?api_key={$this->api_key}");
        $movies = json_decode($response->getBody(), true);
        return view('movies.top_rated', ['movies' => $movies['results']]);
    }

    public function show($id)
    {
        $apiKey = 'ef324be2aeacc1fde00dc484a5a1f1d2';
        $movieUrl = "https://api.themoviedb.org/3/movie/{$id}?api_key={$apiKey}&append_to_response=videos,recommendations";
        $providersUrl = "https://api.themoviedb.org/3/movie/{$id}/watch/providers?api_key={$apiKey}";
        
        // Get movie details
        $movieResponse = file_get_contents($movieUrl);
        $movieData = json_decode($movieResponse, true);
        
        // Get streaming providers
        $providersResponse = file_get_contents($providersUrl);
        $providersData = json_decode($providersResponse, true);

        return view('movies.show', [
            'movie' => $movieData,
            'providers' => $providersData
        ]);
    }

    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $year = $request->input('year');
        $region = $request->input('region');

        $response = $this->client->get("https://api.themoviedb.org/3/search/movie?api_key={$this->api_key}&query={$query}&year={$year}&region={$region}");
        $results = json_decode($response->getBody(), true);

        return view('movies.search', ['results' => $results['results']]);
    }

}
