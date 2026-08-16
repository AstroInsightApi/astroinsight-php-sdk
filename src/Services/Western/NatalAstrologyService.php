<?php

namespace AstroInsight\Services\Western;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\DTO\MatchInput;
use AstroInsight\Http\HttpClient;

class NatalAstrologyService
{
    public function __construct(private HttpClient $client) {}

    public function getPlanets(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/natal-astrology/planets", $payload);
    }

    public function getAspects(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/natal-astrology/aspects", $payload);
    }

    public function getHouseCusps(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/natal-astrology/chart", $payload);
    }

    public function getSynastry(MatchInput|array $matchInput): array
    {
        $payload = $matchInput instanceof MatchInput ? $matchInput->toArray() : $matchInput;
        return $this->client->post("/western/natal-astrology/synastry", $payload);
    }
}
