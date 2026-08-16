<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class VarshaphalService
{
    public function __construct(private HttpClient $client) {}

    public function getVarshaphalPlanets(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/varshaphal/planets", $payload);
    }

    public function getVarshaphalChart(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/varshaphal/chart", $payload);
    }

    public function getVarshaphalDetails(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/varshaphal/details", $payload);
    }

    public function getVarshaphalMuntha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/varshaphal/muntha", $payload);
    }

    public function getVarshaphalBala(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/varshaphal/panchavargeeya-bala", $payload);
    }
}
