<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

use Livewire\Component;

class WeatherDisplay extends Component
{
    public $longitude;
    public $latitude;
    private $openWeatherKey;
    public $weatherData ;
    public $temperature = null;
    public $weather = null;
    public $icon = null;

    public function mount() {
        $this->openWeatherKey = config('services.openweather.key');

        if (!session()->has('weatherData')) {
            $this->longitude = Auth::user()->profile->longitude;
            $this->latitude = Auth::user()->profile->latitude;
            
            $this->fetchWeatherData();
        } else {
            $this->weatherData = session('weatherData');
            $this->formatWeather();
        }
    }

    public function formatWeather() {
        $iconURL = 'https://openweathermap.org/img/wn/';
        $this->temperature = $this->weatherData['main']['temp'];
        $this->weather = $this->weatherData['weather'][0]['main'];
        $this->icon = $iconURL . $this->weatherData['weather'][0]['icon'] . '.png';
    }

    public function fetchWeatherData() {
        if(!$this->longitude || !$this->latitude) {
            session()->flash('error', 'Insufficient data for weather report');
            return;
        }

        $this->apiUrl = 'http://api.openweathermap.org/data/2.5/forecast';
        $this->openWeatherKey = config('services.openweather.key');

        if (!$this->openWeatherKey) {
            throw new \Exception('Open weather key is not in the environment.');
        }

        $response = Http::get($this->apiUrl, [
            'lat' => $this->latitude,
            'lon' => $this->longitude,
            'appid' => $this->openWeatherKey,
            'units' => 'metric',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->weatherData = $data['list'][0] ?? null;
            if($this->weatherData) {
                session(['weatherData' => $this->weatherData]);
            }
            $this->formatWeather();
        } else {
            session()->flash('error', 'Error retrieving weather data');
        }    
    }

    #[On('clear-weather-data')]
    public function clearWeatherData() {
        session()->forget('weatherData');
        $this->weatherData = null;
        session()->flash('message', 'Weather data cleared');

        $this->fetchWeatherData();
    }

    public function render()
    {
        return view('livewire.weather-display');
    }
}
