<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class MuhurtaService
{
    public function __construct(private HttpClient $client) {}

    public function getChoghadiya(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/muhurta/choghadiya", $payload);
    }

    public function getHora(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/muhurta/hora", $payload);
    }

    public function getGouriChoghadiya(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/muhurta/gouri-choghadiya", $payload);
    }

    public function getShubhMuhurta(string $topicKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/muhurta/shubh/" . urlencode($topicKey), $payload);
    }
}
