<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class YoginiDashaService
{
    public function __construct(private HttpClient $client) {}

    public function getMajorDasha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/yogini/major-dasha", $payload);
    }

    public function getAntarDasha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/yogini/antar-dasha", $payload);
    }

    public function getCurrentDasha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/yogini/current-dasha", $payload);
    }
}
