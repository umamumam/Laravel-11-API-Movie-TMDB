<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TMDBController extends Controller
{
    protected $apiKey = 'YOUR_API_KEY'; // Ganti dengan API Key TMDB Anda

    // Menampilkan berbagai kategori film
    public function index($category = 'movie')
    {
        $url = "https://api.themoviedb.org/3/{$category}/popular?api_key={$this->apiKey}&language=en-US";
        $response = Http::get($url)->json();
        return view('tmdb.index', ['movies' => $response['results'], 'category' => $category]);
    }

    // Menampilkan daftar film berdasarkan kategori
    public function showMovies($type)
    {
        $url = "https://api.themoviedb.org/3/movie/{$type}?api_key={$this->apiKey}&language=en-US";
        $response = Http::get($url)->json();
        return view('tmdb.movies', ['movies' => $response['results'], 'type' => $type]);
    }

    // Menampilkan daftar TV berdasarkan kategori
    public function showTVs($type)
    {
        $url = "https://api.themoviedb.org/3/tv/{$type}?api_key={$this->apiKey}&language=en-US";
        $response = Http::get($url)->json();
        return view('tmdb.tv', ['tvs' => $response['results'], 'type' => $type]);
    }

    // Pencarian film atau TV berdasarkan negara dan tahun
    public function search(Request $request)
    {
        $country = $request->input('country');
        $year = $request->input('year');
        $category = $request->input('category', 'movie');
        
        $url = "https://api.themoviedb.org/3/discover/{$category}?api_key={$this->apiKey}&language=en-US&region={$country}&year={$year}";
        $response = Http::get($url)->json();
        return view('tmdb.search', ['results' => $response['results'], 'category' => $category]);
    }

    // Menampilkan detail film
    public function detail($id)
    {
        $movieUrl = "https://api.themoviedb.org/3/movie/{$id}?api_key={$this->apiKey}&append_to_response=videos,recommendations";
        $response = Http::get($movieUrl)->json();

        return view('tmdb.detail', ['movie' => $response]);
    }
}
