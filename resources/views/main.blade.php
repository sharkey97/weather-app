<!DOCTYPE html>
<html>
<head>
    <title>Weather Package Frontend</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Weather Forecast
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">City: {{ $weatherData['name'] }}</h5>
                        <p class="card-title">Temperature: {{ round($weatherData['main']['temp'] - 273.15) }}°C</p>
                        <p class="card-text">Weather Condition: {{ $weatherData['weather'][0]['description'] }}</p>
                        <img src="http://openweathermap.org/img/w/{{ $weatherData['weather'][0]['icon'] }}.png" alt="Weather Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
