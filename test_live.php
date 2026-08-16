<?php

require_once __DIR__ . '/vendor/autoload.php';

use AstroInsight\AstroClient;
use AstroInsight\DTO\BirthDetails;
use AstroInsight\Exceptions\AstroException;

$clientId = 'cd2fed92e1a707adef3d5a843bed353a';
$clientSecret = '138f1d188e7c335c45884ec4661c7533ae2a1af7ed375cba2acd96768278b21b';

$astro = new AstroClient($clientId, $clientSecret);

$birth = new BirthDetails(
    day: 15, month: 8, year: 1995,
    hour: 10, min: 30, sec: 0,
    tzone: 5.5, lat: 28.6139, lon: 77.2090
);

echo "===========================================\n";
echo "LIVE TEST: Astro Insight PHP SDK\n";
echo "===========================================\n\n";

// 1. Birth Details
echo "1. Birth Details:\n";
try {
    $res = $astro->vedic->astroDetails->getBirthDetails($birth);
    echo "   [SUCCESS 200]: " . $res['message'] . "\n";
    echo "   Day: " . $res['data']['birth_details']['day'] . "\n";
} catch (AstroException $e) {
    echo "   [FAILED]: " . $e->getMessage() . "\n";
}

// 2. Planet Ashtak (Sun)
echo "\n2. Sun Bhinnashtakavarga:\n";
try {
    $res = $astro->vedic->ashtakvarga->getPlanetAshtak('sun', $birth);
    echo "   [SUCCESS " . ($res['status_code'] ?? 200) . "]: " . ($res['message'] ?? 'OK') . "\n";
} catch (AstroException $e) {
    echo "   [FAILED]: " . $e->getMessage() . "\n";
}

// 3. One Card Tarot Reading
echo "\n3. One Card Tarot Reading:\n";
try {
    $res = $astro->tarot->getOneCardReading();
    echo "   [SUCCESS " . ($res['status_code'] ?? 200) . "]: " . ($res['message'] ?? 'OK') . "\n";
} catch (AstroException $e) {
    echo "   [FAILED]: " . $e->getMessage() . "\n";
}

// 4. Daily Panchang
echo "\n4. Daily Panchang:\n";
try {
    $res = $astro->vedic->panchang->getDailyPanchang($birth);
    echo "   [SUCCESS " . ($res['status_code'] ?? 200) . "]: " . ($res['message'] ?? 'OK') . "\n";
} catch (AstroException $e) {
    echo "   [FAILED]: " . $e->getMessage() . "\n";
}
