<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class SuggestionsService
{
    public function __construct(private HttpClient $client) {}

    public function getGemstoneSuggestions(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/suggestions/gemstone", $payload);
    }

    public function getRudrakshaSuggestions(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/suggestions/rudraksha", $payload);
    }

    public function getJadiSuggestions(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/suggestions/jadi", $payload);
    }
}
