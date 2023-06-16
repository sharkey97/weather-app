<?php

use Illuminate\Support\Facades\Route;
use Sharkey97\WeatherFromIp\Forecast;
use App\Http\Controllers\ForecastController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather/{ip?}', [ForecastController::class, 'index']);
