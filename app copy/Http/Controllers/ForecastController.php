<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use App\Models\RequestData;
use App\Models\Locations;
use App\Models\Forecasts;
use Illuminate\Support\Facades\Cache;


class ForecastController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index($ip)
{
    // Get the guest IP address from the request

    // Get the weather forecast for the guest IP address
    if (Cache::has($ip)) {
        $weatherData = Cache::get($ip);
    } else {
        // Get the weather forecast for the guest IP address using the WeatherService
        $weatherData = $this->weatherService->getWeatherForecast($ip);

        // Cache the weather forecast for the IP for one hour
        Cache::put($ip, $weatherData, now()->addHour());
    }

    // Create a new RequestData instance
    $requestData = new RequestData();
    $requestData->ip = $ip;
    $requestData->timestamp = now();
    $requestData->save();

    // Create a new Location instance
    $location = new Locations();
    $location->city = $weatherData['name'];
    //$location->request_data_id = $requestData->id;
    $location->save();

    // Create a new Forecast instance
    $forecast = new Forecasts();
    $forecast->temperature = $weatherData['main']['temp'];
    $forecast->location_id = $location->id;
    $forecast->condition = '';
    $forecast->save();

    // Return the weather data to the view
    return view('main', compact('weatherData'));
}
}
