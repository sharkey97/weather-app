<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestData;
use App\Models\Locations;
use App\Models\Forecasts;
use Illuminate\Support\Facades\Cache;
use Sharkey97\WeatherFromIp\Forecast;

class ForecastController extends Controller
{

    public function index($ip)
    {
        // Get the guest IP address from the request

        // Get the weather forecast for the guest IP address
        $weather = app()->make(Forecast::class);
        $weatherData = $weather->index($ip);

        $location = app()->make(Forecast::class);
        $locationData = $location->index($ip, true);

        // Create a new RequestData instance
        $requestData = new RequestData();
        $requestData->ip = $ip;
        $requestData->timestamp = now();
        $requestData->save();

        // Create a new Location instance
        $location = new Locations();
        $location->city = $locationData['city'];
        $location->region = $locationData['region'];
        $location->country = $locationData['country'];
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
