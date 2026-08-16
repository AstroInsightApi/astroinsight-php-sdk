<?php

namespace AstroInsight\Tests\Services;

use AstroInsight\AstroClient;
use AstroInsight\DTO\BirthDetails;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class WesternTest extends TestCase
{
    private function createMockClient(array $responses): AstroClient
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handlerStack]);

        return new AstroClient('client_id', 'client_secret', guzzleClient: $guzzle);
    }

    public function testWesternAstrologyEndpoints(): void
    {
        $astro = $this->createMockClient([
            new Response(200, [], json_encode(['result' => 'western_planets'])),
            new Response(200, [], json_encode(['result' => 'solar_return_details'])),
            new Response(200, [], json_encode(['result' => 'daily_transit'])),
        ]);

        $birth = new BirthDetails(1, 1, 1988, 8, 15);

        $planets = $astro->western->natal->getPlanets($birth);
        $this->assertEquals('western_planets', $planets['result']);

        $solar = $astro->western->solarReturn->getDetails($birth);
        $this->assertEquals('solar_return_details', $solar['result']);

        $transit = $astro->western->transit->getDailyNatalTransit($birth);
        $this->assertEquals('daily_transit', $transit['result']);
    }
}
