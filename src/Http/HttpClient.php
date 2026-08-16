<?php

namespace AstroInsight\Http;

use AstroInsight\Config;
use AstroInsight\Exceptions\AstroException;
use AstroInsight\Exceptions\AuthenticationException;
use AstroInsight\Exceptions\RateLimitException;
use AstroInsight\Exceptions\ServerException;
use AstroInsight\Exceptions\ValidationException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient
{
    private ClientInterface $guzzle;

    public function __construct(
        private Config $config,
        ?ClientInterface $guzzleClient = null
    ) {
        $this->guzzle = $guzzleClient ?? new GuzzleClient([
            'base_uri' => $this->config->baseUrl,
            'timeout' => 30.0,
        ]);
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * Send a POST request to the specified endpoint.
     *
     * @param string $endpoint Endpoint relative to base_url
     * @param array $payload Payload data
     * @param array $headers Custom request headers
     * @return array Decoded JSON response
     * @throws AstroException
     */
    public function post(string $endpoint, array $payload = [], array $headers = []): array
    {
        return $this->request('POST', $endpoint, ['json' => $payload], $headers);
    }

    /**
     * Send a GET request to the specified endpoint.
     *
     * @param string $endpoint Endpoint relative to base_url
     * @param array $query Query parameters
     * @param array $headers Custom request headers
     * @return array Decoded JSON response
     * @throws AstroException
     */
    public function get(string $endpoint, array $query = [], array $headers = []): array
    {
        return $this->request('GET', $endpoint, ['query' => $query], $headers);
    }

    private function request(string $method, string $endpoint, array $options = [], array $headers = []): array
    {
        $endpoint = ltrim($endpoint, '/');
        
        $requestHeaders = array_merge(
            $this->config->getHeaders(),
            $headers
        );

        $options['headers'] = $requestHeaders;
        $options['auth'] = [$this->config->clientId, $this->config->clientSecret];

        try {
            $response = $this->guzzle->request($method, $endpoint, $options);
            $body = (string) $response->getBody();
            return json_decode($body, true) ?? [];
        } catch (BadResponseException $e) {
            $this->handleBadResponse($e);
        } catch (GuzzleException $e) {
            throw new AstroException("Network error: " . $e->getMessage(), $e->getCode(), null, $e);
        }

        return [];
    }

    private function handleBadResponse(BadResponseException $e): void
    {
        $response = $e->getResponse();
        $statusCode = $response ? $response->getStatusCode() : 0;
        $bodyContent = $response ? (string) $response->getBody() : '';
        $data = json_decode($bodyContent, true) ?? [];

        $message = $data['message'] ?? $e->getMessage();

        match (true) {
            $statusCode === 401 || $statusCode === 403 => throw new AuthenticationException($message, $statusCode, $data, $e),
            $statusCode === 422 => throw new ValidationException($message, $statusCode, $data, $data['errors'] ?? [], $e),
            $statusCode === 429 => throw new RateLimitException($message, $statusCode, $data, $e),
            $statusCode >= 500 => throw new ServerException($message, $statusCode, $data, $e),
            default => throw new AstroException($message, $statusCode, $data, $e),
        };
    }
}
