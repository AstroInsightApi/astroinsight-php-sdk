<?php

namespace AstroInsight\Services;

use AstroInsight\Http\HttpClient;

class GeoService
{
    public function __construct(private HttpClient $client) {}

    public function searchPlace(string $place): array
    {
        return $this->client->post("/geo/search", ['place' => $place]);
    }

    public function getTimezoneByTimezoneId(string $timezoneId): array
    {
        return $this->client->post("/geo/timezone", ['timezone_id' => $timezoneId]);
    }

    public function getTimezoneByLatLon(float $lat, float $lon): array
    {
        return $this->client->post("/geo/timezone-with-lat-lon", [
            'lat' => $lat,
            'lon' => $lon,
        ]);
    }
}
