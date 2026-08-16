<?php

namespace AstroInsight\Services;

use AstroInsight\Http\HttpClient;
use AstroInsight\Services\Western\NatalAstrologyService;
use AstroInsight\Services\Western\SolarReturnService;
use AstroInsight\Services\Western\TransitChartService;
use AstroInsight\Services\Western\TransitService;
use AstroInsight\Services\Western\WesternNumerologyService;
use AstroInsight\Services\Western\ZodiacService;

class WesternService
{
    public NatalAstrologyService $natal;
    public SolarReturnService $solarReturn;
    public TransitService $transit;
    public TransitChartService $transitChart;
    public WesternNumerologyService $numerology;
    public ZodiacService $zodiac;

    public function __construct(HttpClient $client)
    {
        $this->natal = new NatalAstrologyService($client);
        $this->solarReturn = new SolarReturnService($client);
        $this->transit = new TransitService($client);
        $this->transitChart = new TransitChartService($client);
        $this->numerology = new WesternNumerologyService($client);
        $this->zodiac = new ZodiacService($client);
    }
}
