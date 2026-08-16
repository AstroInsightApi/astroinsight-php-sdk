<?php

namespace AstroInsight;

class Config
{
    public function __construct(
        public string $clientId,
        public string $clientSecret,
        public string $baseUrl = 'https://json.astroinsightapi.com/api/v1',
        public string $language = 'en',
        public string $ayanamsha = 'lahiri'
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/') . '/';
    }

    public function getHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Accept-Language' => $this->language,
            'X-Ayanamsha' => $this->ayanamsha,
        ];
    }
}
