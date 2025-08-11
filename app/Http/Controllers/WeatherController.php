<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    public function getWeatherForecast()
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $lat = '14.5995'; // Manila latitude as example
        $lon = '120.9842'; // Manila longitude as example
        
        try {
            $response = Http::get("https://api.openweathermap.org/data/2.5/onecall", [
                'lat' => $lat,
                'lon' => $lon,
                'exclude' => 'current,minutely,hourly,alerts',
                'units' => 'metric',
                'appid' => $apiKey
            ]);

            // Debugging: Log the full API response
            Log::debug('Weather API Response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $weatherForecast = array_slice($data['daily'] ?? [], 0, 7);
                return view('your-view', compact('weatherForecast'));
            }

            Log::error('Weather API Error: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('Weather API Exception: ' . $e->getMessage());
        }

        return view('your-view', ['weatherForecast' => []]);
    }
}