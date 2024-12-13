<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class LocationDropdown extends Component
{   
    public $locations = [];
    public $query = ''; 
    private $geonamesUsername;
    private $apiUrl;
    public $selectedLocation = null;

    public function mount($country) {
        if($country) {
            $this->query = $country;
        }
        $this->fetchLocations();
    }

    public function updatedQuery()
    {
        $this->fetchLocations();
    }   

    public function fetchLocations() {
        if (empty($this->query)) {
            $this->locations = [];
            return;
        }

        $this->geonamesUsername = config('services.geonames.username');

        $this->apiUrl = 'http://api.geonames.org/searchJSON';
        if (!$this->geonamesUsername) {
            throw new \Exception('GeoNames username is not in the environment.');
        }
        
        $this->locations = Cache::remember('locations_' . $this->query, 3600, function () {
            $response = Http::get($this->apiUrl, [
                'q'=> $this->query,
                'name_startsWith' => $this->query, 
                'maxRows' => 10,
                'fuzzy' => 0.8, 
                'order_by' => 'relevance',
                'username' => $this->geonamesUsername
            ]);

            $locations = $response->json('geonames', []);
            $filteredLocations = [];

            foreach ($locations as $location) {
                $geonameId = $location['geonameId'] ?? null;
                $city = $location['name'] ?? null;
                $country = $location['countryName'] ?? null;
                $latitude = $location['lat'] ?? null;
                $longitude = $location['lng'] ?? null;

                if ($city && $country && $latitude && $longitude && $geonameId) {
                    $filteredLocations[] = [
                        'geonameId' => $geonameId,
                        'city' => $city,
                        'country' => $country,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ];
                }
            }
            return $filteredLocations;
        });
    }

    public function updateSelectedLocation()
    {
        if (!$this->selectedLocation) {
            session()->flash('error', 'Please select a location');
            return;
        }
        $location = collect($this->locations)->firstWhere('geonameId', $this->selectedLocation);
        if ($location) {
            $this->dispatch('location-selected', $location);
        } else {
            session()->flash('error', 'Location data not found.');
        }
    }

    public function fetchLocationByGeonameId($geonameId)
    {
        $this->apiUrl = 'http://api.geonames.org/get';

        $this->geonamesUsername = config(key: 'services.geonames.username');


        if (!$this->geonamesUsername) {
            throw new \Exception('GeoNames username is not in the environment.');
        }

        $response = Http::get($this->apiUrl, [
            'geonameId' => $geonameId,
            'username' => $this->geonamesUsername
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function render()
    {
        return view('livewire.location-dropdown');
    }
}
