<?php

namespace AstroInsight\Services\Western;

use AstroInsight\Http\HttpClient;

class ZodiacService
{
    public function __construct(private HttpClient $client) {}

    public function getCompatibility(string $signKey, array $payload = []): array
    {
        return $this->client->post("/western/zodiac/compatibility/" . urlencode($signKey), $payload);
    }

    public function getCompatibilityReport(string $yourSignKey, string $partnerSignKey, array $payload = []): array
    {
        return $this->client->post(sprintf("/western/zodiac/compatibility/%s/%s", urlencode($yourSignKey), urlencode($partnerSignKey)), $payload);
    }
}
