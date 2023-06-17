# Weather App
This is an app used to showcase a custom package used to take as url input an IP address and output the city's current weather. It displays the data using a blade template, but the raw data can additionally be accessed for use in the user's code elsewhere.

The code requires at least one API call to retrieve location, and requires two for outputting weather. Both the IP and weather APIs have redundancy so if max requests have been reached or the API crashes, it will automatically switch to another.

<H1> Working Example </H1>

To access the packages view, the user must navigate to the 'weather' route, followed by their desired IP address. For example "http://domain/weather/122.62.248.72"
This will output the blade template and display basic information such as the location, temperature, general weather condition, and image. Example below

<img src="![image](https://github.com/sharkey97/weather-app/assets/45834305/f0588444-07b8-49d6-860c-f00e5ada8d9a)">

If the user wishes to display on screen only the raw data, they can do so by following one of the two address: "http://localhost:8888/forecast/122.62.248.72/location", or "http://localhost:8888/forecast/122.62.248.72/weather". This will display a raw dump of the JSON data provided by the API.
Furthermore, if the user wishes to access this raw data in the code, they can do so by calling the Forecast class provided by the package, example below.

```     
use Sharkey97\WeatherFromIp\Forecast;

//define class and function

$weather = app()->make(Forecast::class);
$weatherData = $weather->index($ip);

$location = app()->make(Forecast::class);
$locationData = $location->index($ip, true);
```

<H3> Database </h3>

The ```ForecastController.php``` saves all data to a MySQL database, and saves into 3 linked tables, 'request_data', 'locations', and 'forecasts'. Where a request has one location, which has many forecasts. 

The Database has a default configuration of:
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=password

<H3> Running </H3>

Due to the package using an API, the user must create an API key and store it in the .env file:  
```OPEN_WEATHER_MAP_KEY=<your_api_key>```

Firstly, ensure the package is installed.  
```composer require sharkey97/weatherfromip``` 

Then, migrate the database.
```docker-compose exec app php artisan migrate      ``` 

The app uses docker to run, and must be initiated using the following commands

1. Start the docker file: 
    ```docker-compose up -d``` 
2. Add encryption key: 
    ```docker-compose exec app php artisan key:generate``` 
    
The app will be hosted on localhost:8888. Test the app by visiting: "http://localhost:8888/weather/122.62.248.72"

<H3> Future Development</H3>

To improve the functionality of this app further, I would add more to the view, such as adding an interacive map using leaflet. I would also give the user more flexibilty in the options to input IP addresses through a UI based formfield rather than pass the information in through the URL.
 
