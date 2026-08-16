<?php

namespace AstroInsight;

use AstroInsight\Http\HttpClient;
use AstroInsight\Services\ChineseAstrologyService;
use AstroInsight\Services\GeoService;
use AstroInsight\Services\HoroscopeService;
use AstroInsight\Services\TarotService;
use AstroInsight\Services\VedicService;
use AstroInsight\Services\WesternService;
use GuzzleHttp\ClientInterface;

class AstroClient
{
    private HttpClient $httpClient;

    public VedicService $vedic;
    public WesternService $western;
    public HoroscopeService $horoscope;
    public TarotService $tarot;
    public ChineseAstrologyService $chinese;
    public GeoService $geo;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $baseUrl = 'https://api.astroinsight.io/v1',
        string $language = 'en',
        string $ayanamsha = 'lahiri',
        ?ClientInterface $guzzleClient = null
    ) {
        $config = new Config(
            clientId: $clientId,
            clientSecret: $clientSecret,
            baseUrl: $baseUrl,
            language: $language,
            ayanamsha: $ayanamsha
        );

        $this->httpClient = new HttpClient($config, $guzzleClient);

        $this->vedic = new VedicService($this->httpClient);
        $this->western = new WesternService($this->httpClient);
        $this->horoscope = new HoroscopeService($this->httpClient);
        $this->tarot = new TarotService($this->httpClient);
        $this->chinese = new ChineseAstrologyService($this->httpClient);
        $this->geo = new GeoService($this->httpClient);
    }

    public function setLanguage(string $language): self
    {
        $this->httpClient->getConfig()->language = $language;
        return $this;
    }

    public function setAyanamsha(string $ayanamsha): self
    {
        $this->httpClient->getConfig()->ayanamsha = $ayanamsha;
        return $this;
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }
}
