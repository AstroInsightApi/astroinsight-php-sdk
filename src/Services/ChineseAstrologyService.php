<?php

namespace AstroInsight\Services;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class ChineseAstrologyService
{
    public function __construct(private HttpClient $client) {}

    public function getZodiac(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/chinese/zodiac", $payload);
    }

    public function getDetailedZodiac(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/chinese/zodiac/detailed", $payload);
    }

    public function getCompatibility(array $payload): array
    {
        return $this->client->post("/chinese/zodiac/compatibility", $payload);
    }

    public function getCompatibilityBySign(string $signKey, array $payload = []): array
    {
        return $this->client->post("/chinese/zodiac/compatibility/" . urlencode($signKey), $payload);
    }

    public function getCompatibilityReport(string $yourSignKey, string $partnerSignKey, array $payload = []): array
    {
        return $this->client->post(sprintf("/chinese/zodiac/compatibility/%s/%s", urlencode($yourSignKey), urlencode($partnerSignKey)), $payload);
    }
}
