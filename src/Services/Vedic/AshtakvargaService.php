<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class AshtakvargaService
{
    public function __construct(private HttpClient $client) {}

    /**
     * Get Planet Ashtak (Bhinnashtakavarga) for a specified planet.
     * Allowed planets: sun, moon, mars, mercury, jupiter, venus, saturn, rahu, ascendant
     */
    public function getPlanetAshtak(string $ashtakPlanetKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/ashtakvarga/planetashtak/" . strtolower($ashtakPlanetKey), $payload);
    }

    /**
     * Get Sarvashtakvarga (Combined Ashtakavarga scores across all planets & houses).
     */
    public function getSarvashtakvarga(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/ashtakvarga/sarvashtak", $payload);
    }
}
