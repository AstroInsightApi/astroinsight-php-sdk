<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class CharDashaService
{
    public function __construct(private HttpClient $client) {}

    public function getMajorDasha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/char/major-dasha", $payload);
    }

    public function getAntarDasha(string $rashiKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/char/antar-dasha/" . urlencode($rashiKey), $payload);
    }

    public function getCurrentDasha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/char/current-dasha", $payload);
    }
}
