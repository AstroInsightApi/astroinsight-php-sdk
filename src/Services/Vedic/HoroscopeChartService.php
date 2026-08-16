<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class HoroscopeChartService
{
    public function __construct(private HttpClient $client) {}

    /**
     * Get horoscope chart data (e.g. D1, D9, D10, etc.)
     */
    public function getChart(string $chartId, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/horoscope/chart/" . urlencode($chartId), $payload);
    }

    /**
     * Get SVG / PNG image endpoint for horoscope chart
     */
    public function getChartImage(string $chartId, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/horoscope/chart/image/" . urlencode($chartId), $payload);
    }
}
