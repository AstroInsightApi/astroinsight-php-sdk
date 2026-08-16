<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class NumerologyService
{
    public function __construct(private HttpClient $client) {}

    public function getVedicNumerology(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/numerology/vedic", $payload);
    }
}
