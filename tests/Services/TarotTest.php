<?php

namespace AstroInsight\Tests\Services;

use AstroInsight\AstroClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class TarotTest extends TestCase
{
    private function createMockClient(array $responses): AstroClient
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handlerStack]);

        return new AstroClient('client_id', 'client_secret', guzzleClient: $guzzle);
    }

    public function testTarotReadings(): void
    {
        $astro = $this->createMockClient([
            new Response(200, [], json_encode(['card' => 'The Fool', 'meaning' => 'New beginnings'])),
            new Response(200, [], json_encode(['spread' => 'three_card'])),
            new Response(200, [], json_encode(['answer' => 'Yes'])),
        ]);

        $oneCard = $astro->tarot->getOneCardReading();
        $this->assertEquals('The Fool', $oneCard['card']);

        $threeCard = $astro->tarot->getThreeCardReading();
        $this->assertEquals('three_card', $threeCard['spread']);

        $yesNo = $astro->tarot->getYesNoReading();
        $this->assertEquals('Yes', $yesNo['answer']);
    }
}
