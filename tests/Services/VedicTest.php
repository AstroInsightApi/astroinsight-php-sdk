<?php

namespace AstroInsight\Tests\Services;

use AstroInsight\AstroClient;
use AstroInsight\DTO\BirthDetails;
use AstroInsight\DTO\MatchInput;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class VedicTest extends TestCase
{
    private function createMockClient(array $responses): AstroClient
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handlerStack]);

        return new AstroClient('client_id', 'client_secret', guzzleClient: $guzzle);
    }

    public function testVedicAstrologyEndpoints(): void
    {
        $astro = $this->createMockClient([
            new Response(200, [], json_encode(['result' => 'ghat_chakra'])),
            new Response(200, [], json_encode(['result' => 'vimshottari_major'])),
            new Response(200, [], json_encode(['result' => 'guna_milan_total', 'total_points' => 28])),
            new Response(200, [], json_encode(['result' => 'daily_panchang'])),
            new Response(200, [], json_encode(['result' => 'gemstone_remedy'])),
        ]);

        $birth = new BirthDetails(10, 5, 1990, 14, 20);

        $ghat = $astro->vedic->astroDetails->getGhatChakra($birth);
        $this->assertEquals('ghat_chakra', $ghat['result']);

        $dasha = $astro->vedic->vimshottariDasha->getMajorDasha($birth);
        $this->assertEquals('vimshottari_major', $dasha['result']);

        $matchInput = new MatchInput($birth, new BirthDetails(12, 8, 1992, 18, 0));
        $guna = $astro->vedic->matchMaking->getGunaMilan($matchInput);
        $this->assertEquals(28, $guna['total_points']);

        $panchang = $astro->vedic->panchang->getDailyPanchang($birth);
        $this->assertEquals('daily_panchang', $panchang['result']);

        $gems = $astro->vedic->suggestions->getGemstoneSuggestions($birth);
        $this->assertEquals('gemstone_remedy', $gems['result']);
    }
}
