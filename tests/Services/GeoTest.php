<?php

namespace AstroInsight\Tests\Services;

use AstroInsight\AstroClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GeoTest extends TestCase
{
    private function createMockClient(array $responses): AstroClient
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handlerStack]);

        return new AstroClient('client_id', 'client_secret', guzzleClient: $guzzle);
    }

    public function testGeoServices(): void
    {
        $astro = $this->createMockClient([
            new Response(200, [], json_encode(['places' => [['name' => 'Delhi', 'lat' => 28.6139, 'lon' => 77.2090]]])),
            new Response(200, [], json_encode(['timezone' => 'Asia/Kolkata', 'tzone' => 5.5])),
        ]);

        $places = $astro->geo->searchPlace('Delhi');
        $this->assertEquals('Delhi', $places['places'][0]['name']);

        $tz = $astro->geo->getTimezoneByLatLon(28.6139, 77.2090);
        $this->assertEquals('Asia/Kolkata', $tz['timezone']);
    }
}
