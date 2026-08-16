<?php

namespace AstroInsight\Services;

use AstroInsight\Http\HttpClient;

class TarotService
{
    public function __construct(private HttpClient $client) {}

    public function getOneCardReading(array $payload = []): array
    {
        return $this->client->post("/tarot/one-card", $payload);
    }

    public function getThreeCardReading(array $payload = []): array
    {
        return $this->client->post("/tarot/three-card", $payload);
    }

    public function getCelticCrossReading(array $payload = []): array
    {
        return $this->client->post("/tarot/celtic-cross", $payload);
    }

    public function getHealthReading(array $payload = []): array
    {
        return $this->client->post("/tarot/health", $payload);
    }

    public function getCareerReading(array $payload = []): array
    {
        return $this->client->post("/tarot/career", $payload);
    }

    public function getCareerPathReading(array $payload = []): array
    {
        return $this->client->post("/tarot/career-path", $payload);
    }

    public function getFinanceReading(array $payload = []): array
    {
        return $this->client->post("/tarot/finance", $payload);
    }

    public function getTrueLoveReading(array $payload = []): array
    {
        return $this->client->post("/tarot/true-love", $payload);
    }

    public function getVictoryReading(array $payload = []): array
    {
        return $this->client->post("/tarot/victory", $payload);
    }

    public function getLoveReading(array $payload = []): array
    {
        return $this->client->post("/tarot/love", $payload);
    }

    public function getSpiritualReading(array $payload = []): array
    {
        return $this->client->post("/tarot/spiritual", $payload);
    }

    public function getBirthReading(array $payload = []): array
    {
        return $this->client->post("/tarot/birth", $payload);
    }

    public function getYesNoReading(array $payload = []): array
    {
        return $this->client->post("/tarot/yes-no", $payload);
    }
}
