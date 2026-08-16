<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class LalKitabService
{
    public function __construct(private HttpClient $client) {}

    public function getLalKitabDebts(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/lalkitab/debts", $payload);
    }

    public function getLalKitabPlanets(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/lalkitab/planets", $payload);
    }

    public function getLalKitabHouses(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/lalkitab/houses", $payload);
    }

    public function getLalKitabRemedies(string $planetKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/lalkitab/remedies/" . urlencode($planetKey), $payload);
    }
}
