<?php

namespace AstroInsight\Services;

use AstroInsight\Http\HttpClient;
use AstroInsight\Services\Vedic\AshtakvargaService;
use AstroInsight\Services\Vedic\AstroDetailsService;
use AstroInsight\Services\Vedic\BiorhythmService;
use AstroInsight\Services\Vedic\CharDashaService;
use AstroInsight\Services\Vedic\HoroscopeChartService;
use AstroInsight\Services\Vedic\HoroscopeDoshaService;
use AstroInsight\Services\Vedic\JaiminiService;
use AstroInsight\Services\Vedic\KPService;
use AstroInsight\Services\Vedic\LalKitabService;
use AstroInsight\Services\Vedic\LifeReportService;
use AstroInsight\Services\Vedic\MatchMakingService;
use AstroInsight\Services\Vedic\MuhurtaService;
use AstroInsight\Services\Vedic\NumerologyService;
use AstroInsight\Services\Vedic\PanchangService;
use AstroInsight\Services\Vedic\SuggestionsService;
use AstroInsight\Services\Vedic\VarshaphalService;
use AstroInsight\Services\Vedic\VimshottariDashaService;
use AstroInsight\Services\Vedic\YoginiDashaService;

class VedicService
{
    public AshtakvargaService $ashtakvarga;
    public AstroDetailsService $astroDetails;
    public BiorhythmService $biorhythm;
    public CharDashaService $charDasha;
    public HoroscopeChartService $horoscopeChart;
    public HoroscopeDoshaService $horoscopeDosha;
    public JaiminiService $jaimini;
    public KPService $kp;
    public LalKitabService $lalKitab;
    public LifeReportService $lifeReport;
    public MatchMakingService $matchMaking;
    public MuhurtaService $muhurta;
    public NumerologyService $numerology;
    public PanchangService $panchang;
    public SuggestionsService $suggestions;
    public VarshaphalService $varshaphal;
    public VimshottariDashaService $vimshottariDasha;
    public YoginiDashaService $yoginiDasha;

    public function __construct(HttpClient $client)
    {
        $this->ashtakvarga = new AshtakvargaService($client);
        $this->astroDetails = new AstroDetailsService($client);
        $this->biorhythm = new BiorhythmService($client);
        $this->charDasha = new CharDashaService($client);
        $this->horoscopeChart = new HoroscopeChartService($client);
        $this->horoscopeDosha = new HoroscopeDoshaService($client);
        $this->jaimini = new JaiminiService($client);
        $this->kp = new KPService($client);
        $this->lalKitab = new LalKitabService($client);
        $this->lifeReport = new LifeReportService($client);
        $this->matchMaking = new MatchMakingService($client);
        $this->muhurta = new MuhurtaService($client);
        $this->numerology = new NumerologyService($client);
        $this->panchang = new PanchangService($client);
        $this->suggestions = new SuggestionsService($client);
        $this->varshaphal = new VarshaphalService($client);
        $this->vimshottariDasha = new VimshottariDashaService($client);
        $this->yoginiDasha = new YoginiDashaService($client);
    }
}
