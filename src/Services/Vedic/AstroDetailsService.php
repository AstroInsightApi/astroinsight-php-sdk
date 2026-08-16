<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class AstroDetailsService
{
    public function __construct(private HttpClient $client) {}

    public function getBirthDetails(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/astro-details/birth-details", $payload);
    }

    public function getBasicAstroDetails(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/astro-details/basic-astro-details", $payload);
    }

    public function getAstroDetails(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/astro-details/astro-details", $payload);
    }

    public function getPlanets(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/astro-details/planets", $payload);
    }

    public function getPlanetsExtended(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/astro-details/planets-extended", $payload);
    }

    public function getGhatChakra(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/astro-details/ghat-chakra", $payload);
    }

    public function getPlanetaryFriendship(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/astro-details/planetary-friendship", $payload);
    }
}
