<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class WeatherService
{
    public function getWeatherForecast($city)
    {
        $apiKey = Config::get('services.openweathermap.key'); // Replace with your actual API key
        // $cityTest = 'London';

        $response = Http::get("api.openweathermap.org/data/2.5/weather?id=524901&appid={$apiKey}&q={$city}");
        $weatherData = $response->json();

        return $weatherData;
    }
}
