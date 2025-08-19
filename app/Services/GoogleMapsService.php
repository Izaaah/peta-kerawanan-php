<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleMapsService
{
    protected $apiKey;
    
    public function __construct()
    {
        $this->apiKey = config('services.google.maps_api_key');
    }
    
    /**
     * Get coordinates from address using Google Geocoding API
     */
    public function getCoordinatesFromAddress($address)
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $address,
                'key' => $this->apiKey,
            ]);
            
            $data = $response->json();
            
            if ($data['status'] === 'OK' && !empty($data['results'])) {
                $location = $data['results'][0]['geometry']['location'];
                return [
                    'latitude' => $location['lat'],
                    'longitude' => $location['lng'],
                    'formatted_address' => $data['results'][0]['formatted_address'],
                ];
            }
            
            Log::warning('Google Geocoding API returned no results', [
                'address' => $address,
                'status' => $data['status'] ?? 'unknown'
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error calling Google Geocoding API', [
                'address' => $address,
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }
    
    /**
     * Search for places using Google Places API
     */
    public function searchPlaces($query)
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
                'query' => $query,
                'key' => $this->apiKey,
            ]);
            
            $data = $response->json();
            
            if ($data['status'] === 'OK' && !empty($data['results'])) {
                $places = [];
                foreach ($data['results'] as $place) {
                    $places[] = [
                        'name' => $place['name'],
                        'formatted_address' => $place['formatted_address'],
                        'latitude' => $place['geometry']['location']['lat'],
                        'longitude' => $place['geometry']['location']['lng'],
                        'place_id' => $place['place_id'],
                    ];
                }
                return $places;
            }
            
            Log::warning('Google Places API returned no results', [
                'query' => $query,
                'status' => $data['status'] ?? 'unknown'
            ]);
            
            return [];
        } catch (\Exception $e) {
            Log::error('Error calling Google Places API', [
                'query' => $query,
                'error' => $e->getMessage()
            ]);
            
            return [];
        }
    }
    
    /**
     * Get place details using Google Places API
     */
    public function getPlaceDetails($placeId)
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $placeId,
                'fields' => 'name,formatted_address,geometry,place_id',
                'key' => $this->apiKey,
            ]);
            
            $data = $response->json();
            
            if ($data['status'] === 'OK' && isset($data['result'])) {
                $place = $data['result'];
                return [
                    'name' => $place['name'],
                    'formatted_address' => $place['formatted_address'],
                    'latitude' => $place['geometry']['location']['lat'],
                    'longitude' => $place['geometry']['location']['lng'],
                    'place_id' => $place['place_id'],
                ];
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error calling Google Places Details API', [
                'place_id' => $placeId,
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }
}