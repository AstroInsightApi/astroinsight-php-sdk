<?php

namespace AstroInsight\Services\Western;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class SolarReturnService
{
    public function __construct(private HttpClient $client) {}

    public function getDetails(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/solar-return/details", $payload);
    }

    public function getPlanets(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/solar-return/planets", $payload);
    }

    public function getHouseCusps(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/solar-return/house-cusps", $payload);
    }

    public function getPlanetAspects(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/solar-return/planet-aspects", $payload);
    }
}
