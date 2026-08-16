# Astro Insight PHP SDK

[![Latest Stable Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://packagist.org/packages/astro-insight/php-sdk)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.1-8892BF.svg)](https://php.net/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Official, strongly-typed **PHP 8.1+ SDK** for the **Astro Insight API**. Easily integrate comprehensive Vedic Astrology, Western Astrology, Matchmaking, Panchang, Muhurta, Tarot, Numerology, Chinese Astrology, and Geolocation calculations into your PHP applications.

---

## Features

- 🪐 **Vedic Astrology**: Ashtakvarga, Vimshottari / Char / Yogini Dashas, KP System, Jaimini, Lal Kitab, Varshaphal, Ghat Chakra, Horoscope Charts & Doshas.
- 💍 **Matchmaking**: Guna Milan, Kundali Compatibility, Manglik Matching.
- 🗓️ **Panchang & Muhurta**: Daily Panchang, Choghadiya, Hora, Shubh Muhurta timing.
- 🔮 **Western Astrology & Tarot**: Natal Charts, Solar Return, Daily/Weekly/Monthly Transits, Synastry, Tarot spreads (One-card, Three-card, Celtic Cross, Love, Career).
- 🔢 **Numerology**: Vedic & Western Numerology (Life Path, Destiny, Soul Urge).
- ☯️ **Chinese Astrology & Biorhythm**: Zodiac sign compatibility & biorhythm calculations.
- 🌍 **Geo Utilities**: Place search, timezone lookup by coordinates or ID.
- 🛡️ **Strongly Typed DTOs**: Clean `BirthDetails`, `MatchInput`, and `GeoLocation` objects.
- ⚡ **PSR-4 Compliant & Guzzle Powered**: Exception handling for authentication, validation (422), rate limits (429), and server errors.

---

## Installation

Install the package via Composer:

```bash
composer require astroinsightapi/astroinsight-php-sdk
```

---

## Quick Start

### 1. Initialize the Client

```php
use AstroInsight\AstroClient;

$astro = new AstroClient(
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    baseUrl: 'https://json.astroinsightapi.com/api/v1', // Optional
    language: 'en',                             // Optional (e.g. 'hi', 'es')
    ayanamsha: 'lahiri'                         // Optional (e.g. 'raman', 'kp')
);
```

### 2. Using Data Transfer Objects (DTOs)

Create a `BirthDetails` object for birth chart calculations:

```php
use AstroInsight\DTO\BirthDetails;

$birth = new BirthDetails(
    day: 15,
    month: 8,
    year: 1995,
    hour: 10,
    min: 30,
    sec: 0,
    tzone: 5.5,
    lat: 28.6139,
    lon: 77.2090
);
```

---

## Code Examples

### 🪐 Vedic Astrology & Dashas

```php
// 1. Get Sun Bhinnashtakavarga
$sunAshtak = $astro->vedic->ashtakvarga->getPlanetAshtak('sun', $birth);

// 2. Fetch Major Vimshottari Dasha
$vimshottari = $astro->vedic->vimshottariDasha->getMajorDasha($birth);

// 3. Get Gemstone & Rudraksha Remedies
$gemstones = $astro->vedic->suggestions->getGemstoneSuggestions($birth);

// 4. Check Manglik Dosha
$manglik = $astro->vedic->horoscopeDosha->getManglikDosha($birth);
```

### 💍 Matchmaking (Guna Milan)

```php
use AstroInsight\DTO\MatchInput;

$maleBirth = new BirthDetails(15, 8, 1995, 10, 30, lat: 28.6139, lon: 77.2090);
$femaleBirth = new BirthDetails(20, 11, 1997, 14, 15, lat: 19.0760, lon: 72.8777);

$matchInput = new MatchInput($maleBirth, $femaleBirth);

// Calculate Guna Milan
$gunaScore = $astro->vedic->matchMaking->getGunaMilan($matchInput);
```

### 🗓️ Daily Panchang & Muhurta

```php
// Daily Panchang
$panchang = $astro->vedic->panchang->getDailyPanchang($birth);

// Choghadiya Timings
$choghadiya = $astro->vedic->muhurta->getChoghadiya($birth);
```

### 🔮 Tarot Readings

```php
// One Card Tarot Reading
$oneCard = $astro->tarot->getOneCardReading();

// Three Card Tarot Reading
$threeCard = $astro->tarot->getThreeCardReading();

// Yes / No Tarot Reading
$yesNo = $astro->tarot->getYesNoReading();
```

### 📊 Horoscope Predictions

```php
// Daily Horoscope for Leo
$leoDaily = $astro->horoscope->getDailyHoroscope('leo');

// Monthly Horoscope for Aries
$ariesMonthly = $astro->horoscope->getMonthlyHoroscope('aries');
```

---

## Dynamic Configuration & Headers

You can update the default language or Ayanamsha dynamically on the client:

```php
// Switch language to Hindi
$astro->setLanguage('hi');

// Switch Ayanamsha calculation system
$astro->setAyanamsha('raman');
```

---

## Exception Handling

All API errors throw domain-specific exceptions extending `AstroInsight\Exceptions\AstroException`:

```php
use AstroInsight\Exceptions\AuthenticationException;
use AstroInsight\Exceptions\ValidationException;
use AstroInsight\Exceptions\RateLimitException;
use AstroInsight\Exceptions\AstroException;

try {
    $response = $astro->vedic->panchang->getDailyPanchang($birth);
} catch (AuthenticationException $e) {
    echo "Invalid Client ID or Secret: " . $e->getMessage();
} catch (ValidationException $e) {
    echo "Validation failed: " . $e->getMessage();
    print_r($e->getErrors());
} catch (RateLimitException $e) {
    echo "Rate limit exceeded. Try again later.";
} catch (AstroException $e) {
    echo "API Error: " . $e->getMessage();
}
```

---

## Running Tests

To run the unit test suite using PHPUnit:

```bash
php composer.phar install
./vendor/bin/phpunit
```

---

## License

This SDK is open-sourced software licensed under the [MIT License](LICENSE).
