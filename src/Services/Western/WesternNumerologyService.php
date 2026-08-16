<?php

namespace AstroInsight\Services\Western;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class WesternNumerologyService
{
    public function __construct(private HttpClient $client) {}

    public function getNumerologicalNumbers(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/numerology/numerological-numbers", $payload);
    }

    public function getLifePathReport(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/numerology/report/life-path-number", $payload);
    }

    public function getExpressionReport(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/numerology/report/expression-number", $payload);
    }

    public function getSoulUrgeReport(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/numerology/report/soul-urge-number", $payload);
    }

    public function getSubconsciousSelfReport(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/numerology/report/subconscious-self-number", $payload);
    }

    public function getPersonalityReport(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/numerology/report/personality-number", $payload);
    }
}
