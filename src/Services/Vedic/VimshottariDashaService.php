<?php

namespace AstroInsight\Services\Vedic;

use AstroInsight\DTO\BirthDetails;
use AstroInsight\Http\HttpClient;

class VimshottariDashaService
{
    public function __construct(private HttpClient $client) {}

    public function getMajorDasha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/vimshottari/major-dasha", $payload);
    }

    public function getAntarDasha(string $majorDashaKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/vimshottari/antar-dasha/" . urlencode($majorDashaKey), $payload);
    }

    public function getPratyantarDasha(string $majorDashaKey, string $antarDashaKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post(sprintf("/dasha/vimshottari/pratyantar-dasha/%s/%s", urlencode($majorDashaKey), urlencode($antarDashaKey)), $payload);
    }

    public function getSookshmaDasha(string $majorDashaKey, string $antarDashaKey, string $pratyantarDashaKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post(sprintf("/dasha/vimshottari/sookshma-dasha/%s/%s/%s", urlencode($majorDashaKey), urlencode($antarDashaKey), urlencode($pratyantarDashaKey)), $payload);
    }

    public function getPranDasha(string $majorDashaKey, string $antarDashaKey, string $pratyantarDashaKey, string $sookshmaDashaKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post(sprintf("/dasha/vimshottari/pran-dasha/%s/%s/%s/%s", urlencode($majorDashaKey), urlencode($antarDashaKey), urlencode($pratyantarDashaKey), urlencode($sookshmaDashaKey)), $payload);
    }

    public function getCurrentDasha(BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/vimshottari/current-dasha", $payload);
    }

    public function getMahadashaPhal(string $planetKey, BirthDetails|array $birthDetails): array
    {
        $payload = $birthDetails instanceof BirthDetails ? $birthDetails->toArray() : $birthDetails;
        return $this->client->post("/dasha/vimshottari/mahadasha-phal/" . urlencode($planetKey), $payload);
    }
}
