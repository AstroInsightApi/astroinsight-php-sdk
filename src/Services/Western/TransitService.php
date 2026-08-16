<?php

namespace AstroInsight\Services\Western;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class TransitService
{
    public function __construct(private HttpClient $client) {}

    public function getDailyNatalTransit(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/daily", $payload);
    }

    public function getWeeklyNatalTransit(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/weekly", $payload);
    }

    public function getMonthlyNatalTransit(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/monthly", $payload);
    }

    public function getDailyTiming(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/timing/daily", $payload);
    }

    public function getWeeklyTiming(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/timing/weekly", $payload);
    }

    public function getMonthlyTiming(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/western/transits/natal/timing/monthly", $payload);
    }
}
