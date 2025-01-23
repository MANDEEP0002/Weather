<?php
// WeatherController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    private $apiKey = 'b51e6f9c23954915988170927252301';

    public function index()
    {
        return view('welcome');
    }

    // public function getWeather(Request $request)
    // {
    //     $city = $request->input('city', 'London');
        
    //     try {
    //         $response = Http::get("http://api.weatherapi.com/v1/current.json", [
    //             'key' => $this->apiKey,
    //             'q' => $city,
    //             'aqi' => 'no'
    //         ]);

    //         $weatherData = $response->json();

    //         return view('weather.result', [
    //             'city' => $city,
    //             'weather' => $weatherData
    //         ]);
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Weather data fetch failed');
    //     }
    // }
}