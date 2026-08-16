<?php

namespace AstroInsight\Tests;

use AstroInsight\AstroClient;
use AstroInsight\DTO\BirthDetails;
use AstroInsight\Exceptions\AuthenticationException;
use AstroInsight\Exceptions\ValidationException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class AstroClientTest extends TestCase
{
    public function testClientInitializationAndHeaders(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['status' => true, 'data' => ['planet' => 'sun']])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handlerStack]);

        $astro = new AstroClient(
            clientId: 'test_client_id',
            clientSecret: 'test_client_secret',
            baseUrl: 'https://api.test.com/v1',
            language: 'hi',
            ayanamsha: 'raman',
            guzzleClient: $guzzle
        );

        $this->assertEquals('hi', $astro->getHttpClient()->getConfig()->language);
        $this->assertEquals('raman', $astro->getHttpClient()->getConfig()->ayanamsha);

        $astro->setLanguage('en')->setAyanamsha('lahiri');
        $this->assertEquals('en', $astro->getHttpClient()->getConfig()->language);
        $this->assertEquals('lahiri', $astro->getHttpClient()->getConfig()->ayanamsha);

        $birthDetails = new BirthDetails(
            day: 15, month: 8, year: 1995, hour: 10, min: 30, sec: 0, tzone: 5.5, lat: 28.6139, lon: 77.2090
        );

        $response = $astro->vedic->ashtakvarga->getPlanetAshtak('sun', $birthDetails);
        $this->assertTrue($response['status']);
        $this->assertEquals('sun', $response['data']['planet']);
    }

    public function testAuthenticationException(): void
    {
        $mock = new MockHandler([
            new Response(401, [], json_encode(['message' => 'Unauthorized client credentials'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handlerStack]);

        $astro = new AstroClient('wrong_id', 'wrong_secret', guzzleClient: $guzzle);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Unauthorized client credentials');

        $astro->vedic->astroDetails->getAstroDetails(new BirthDetails(1, 1, 2000, 12, 0));
    }

    public function testValidationException(): void
    {
        $mock = new MockHandler([
            new Response(422, [], json_encode([
                'message' => 'The given data was invalid.',
                'errors' => ['lat' => ['Latitude is required.']]
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handlerStack]);

        $astro = new AstroClient('test', 'test', guzzleClient: $guzzle);

        try {
            $astro->vedic->panchang->getDailyPanchang(new BirthDetails(1, 1, 2000, 12, 0));
            $this->fail('ValidationException was not thrown');
        } catch (ValidationException $e) {
            $this->assertEquals(422, $e->getCode());
            $this->assertArrayHasKey('lat', $e->getErrors());
        }
    }
}
