<?php

namespace AstroInsight\Services;

use AstroInsight\Http\HttpClient;

class HoroscopeService
{
    public function __construct(private HttpClient $client) {}

    public function getDailyHoroscope(string $sunSign): array
    {
        return $this->client->post("/horoscope/daily/" . urlencode(strtolower($sunSign)));
    }

    public function getDetailedDailyHoroscope(string $sunSign): array
    {
        return $this->client->post(sprintf("/horoscope/daily/%s/detailed", urlencode(strtolower($sunSign))));
    }

    public function getTomorrowDailyHoroscope(string $sunSign): array
    {
        return $this->client->post(sprintf("/horoscope/daily/%s/tomorrow", urlencode(strtolower($sunSign))));
    }

    public function getYesterdayDailyHoroscope(string $sunSign): array
    {
        return $this->client->post(sprintf("/horoscope/daily/%s/yesterday", urlencode(strtolower($sunSign))));
    }

    public function getMonthlyHoroscope(string $sunSign): array
    {
        return $this->client->post("/horoscope/monthly/" . urlencode(strtolower($sunSign)));
    }

    public function getDetailedMonthlyHoroscope(string $sunSign): array
    {
        return $this->client->post(sprintf("/horoscope/monthly/%s/detailed", urlencode(strtolower($sunSign))));
    }
}
