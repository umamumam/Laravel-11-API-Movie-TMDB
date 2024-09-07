<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TvController extends Controller
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
        $response = $this->client->get("https://api.themoviedb.org/3/tv/popular?api_key={$this->api_key}");
        $tvShows = json_decode($response->getBody(), true);
        return view('tv.index', ['tvShows' => $tvShows['results']]);
    }

    public function airingToday()
    {
        $response = $this->client->get("https://api.themoviedb.org/3/tv/airing_today?api_key={$this->api_key}");
        $tvShows = json_decode($response->getBody(), true);
        return view('tv.airing-today', ['tvShows' => $tvShows['results']]);
    }

    public function onTheAir()
    {
        $response = $this->client->get("https://api.themoviedb.org/3/tv/on_the_air?api_key={$this->api_key}");
        $tvShows = json_decode($response->getBody(), true);
        return view('tv.on-the-air', ['tvShows' => $tvShows['results']]);
    }

    public function topRated()
    {
        $response = $this->client->get("https://api.themoviedb.org/3/tv/top_rated?api_key={$this->api_key}");
        $tvShows = json_decode($response->getBody(), true);
        return view('tv.top-rated', ['tvShows' => $tvShows['results']]);
    }

    public function show($id)
    {
        $apiKey = 'ef324be2aeacc1fde00dc484a5a1f1d2';
        $tvUrl = "https://api.themoviedb.org/3/tv/{$id}?api_key={$apiKey}&append_to_response=videos,recommendations";
        $providersUrl = "https://api.themoviedb.org/3/tv/{$id}/watch/providers?api_key={$apiKey}";
    
        // Get TV show details
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tvUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tvResponse = curl_exec($ch);
        curl_close($ch);
    
        $tvData = json_decode($tvResponse, true);
    
        // Get streaming providers
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $providersUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $providersResponse = curl_exec($ch);
        curl_close($ch);
    
        $providersData = json_decode($providersResponse, true);
    
        return view('tv.show', [
            'tvShow' => $tvData,
            'providers' => $providersData
        ]);
    }
    

    public function search(Request $request)
    {
        $query = $request->input('query');
        $year = $request->input('year');
        $region = $request->input('region');

        $response = $this->client->get("https://api.themoviedb.org/3/search/tv?api_key={$this->api_key}&query={$query}&year={$year}&region={$region}");
        // $response = $this->client->get("search/tv?api_key={$this->api_key}&query={$query}&year={$year}&region={$region}");
        $results = json_decode($response->getBody(), true);

        return view('tv.search', ['results' => $results['results']]);
    }
}
