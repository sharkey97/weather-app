<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IpService
{
    public function getLocation($ipAddress)
    {
        $response = Http::get("https://ipapi.co/122.62.248.72/json/");
        
        if ($response->ok()) {
            return $response->json();
        }
        
        return null;
    }
}
