<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\MatchInput;
use AstroInsight\Http\HttpClient;

class MatchMakingService
{
    public function __construct(private HttpClient $client) {}

    public function getGunaMilan(MatchInput|array $matchInput): array
    {
        $payload = $matchInput instanceof MatchInput ? $matchInput->toArray() : $matchInput;
        return $this->client->post("/matchmaking/guna-milan", $payload);
    }

    public function getMatchMakingReport(MatchInput|array $matchInput): array
    {
        $payload = $matchInput instanceof MatchInput ? $matchInput->toArray() : $matchInput;
        return $this->client->post("/matchmaking/report", $payload);
    }

    public function getManglikMatch(MatchInput|array $matchInput): array
    {
        $payload = $matchInput instanceof MatchInput ? $matchInput->toArray() : $matchInput;
        return $this->client->post("/matchmaking/manglik-match", $payload);
    }
}
