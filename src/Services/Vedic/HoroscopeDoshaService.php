<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class HoroscopeDoshaService
{
    public function __construct(private HttpClient $client) {}

    public function getManglikDosha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/horoscope/dosha/manglik", $payload);
    }

    public function getKalsarpDosha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/horoscope/dosha/kalsarp", $payload);
    }

    public function getPitraDosha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/horoscope/dosha/pitra", $payload);
    }

    public function getSadesatiDetails(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/horoscope/dosha/sadesati", $payload);
    }
}
