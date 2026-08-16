<?php

namespace AstroInsight\Services\Western;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class TransitChartService
{
    public function __construct(private HttpClient $client) {}

    public function getWheelChart(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/wheel-chart", $payload);
    }

    public function getAspectsGrid(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/aspects-grid", $payload);
    }
}
