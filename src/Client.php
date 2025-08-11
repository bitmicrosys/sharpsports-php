<?php

namespace Bitmicrosys\SharpsportsPhp;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected HttpClient $httpClient;
    protected string $apiKey;
    protected string $baseUrl = 'https://api.sharpsports.io/v1/';

    public function __construct(string $apiKey, array $options = [])
    {
        $this->apiKey = $apiKey;

        $defaultOptions = [
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Token ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'timeout' => 30,
        ];

        $this->httpClient = new HttpClient(array_merge($defaultOptions, $options));
    }

    /**
     * Make a GET request to the API
     */
    public function get(string $endpoint, array $query = []): array
    {
        try {
            $response = $this->httpClient->get($endpoint, [
                'query' => $query
            ]);

            return $this->parseResponse($response);
        } catch (GuzzleException $e) {
            throw new SharpsportsException('API request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Make a POST request to the API
     */
    public function post(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->httpClient->post($endpoint, [
                'json' => $data
            ]);

            return $this->parseResponse($response);
        } catch (GuzzleException $e) {
            throw new SharpsportsException('API request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Make a PUT request to the API
     */
    public function put(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->httpClient->put($endpoint, [
                'json' => $data
            ]);

            return $this->parseResponse($response);
        } catch (GuzzleException $e) {
            throw new SharpsportsException('API request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Parse the HTTP response
     */
    protected function parseResponse(ResponseInterface $response): array
    {
        $body = $response->getBody()->getContents();

        // Handle empty responses
        if (empty($body)) {
            return [];
        }

        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new SharpsportsException('Invalid JSON response: ' . json_last_error_msg());
        }

        // Handle API errors
        if ($response->getStatusCode() >= 400) {
            $message = $data['message'] ?? $data['error'] ?? 'Unknown API error';
            throw new SharpsportsException($message, $response->getStatusCode());
        }

        return $data;
    }

    /**
     * Parse list response - handles both direct arrays and data-wrapped responses
     */
    public function parseListResponse(array $response): array
    {
        // If response has a 'data' key, use that
        if (isset($response['data']) && is_array($response['data'])) {
            return $response['data'];
        }

        // If response is already an array of items, return it directly
        if (is_array($response) && !empty($response) && isset($response[0])) {
            return $response;
        }

        // Otherwise return empty array
        return [];
    }

    /**
     * Get the HTTP client instance
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * Set a new API key
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient(array_merge(
            $this->httpClient->getConfig(),
            [
                'headers' => array_merge(
                    $this->httpClient->getConfig('headers') ?? [],
                    ['Authorization' => 'Token ' . $apiKey]
                )
            ]
        ));
    }
}
