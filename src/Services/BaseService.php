<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;

abstract class BaseService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Parse a list response and convert to model instances
     */
    protected function parseListResponse(array $response, string $modelClass): array
    {
        $items = $this->client->parseListResponse($response);
        
        $models = [];
        foreach ($items as $itemData) {
            if (is_array($itemData)) {
                $models[] = $modelClass::fromArray($itemData);
            }
        }
        
        return $models;
    }

    /**
     * Get a single resource by ID
     */
    protected function getById(string $endpoint, string $id): array
    {
        return $this->client->get("{$endpoint}/{$id}");
    }

    /**
     * Get metadata for a resource
     */
    protected function getMetadata(string $endpoint, string $id): array
    {
        return $this->client->get("{$endpoint}/{$id}/metadata");
    }
}
