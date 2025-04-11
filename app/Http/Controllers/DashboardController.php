<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class User {
    public string $name;
}

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $city = 'Kuressaare';
       
        return Inertia::render('Dashboard', [
            
            "weather" => Cache::remember("weather-" . $city, now()->addHour(), fn() => $this->getWeatherData($city)),
             'city' => $city,
             'markers' => Marker::all(),
        ]);
    }

    private function getWeatherData($city)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
           
            'appid' => "9a39f331ece052ceeaa5be6b81615300",
            'q' => $city,
            'units' => 'metric',
        ])->json();

        return $response;
    }
 }
