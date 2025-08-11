<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Sport;

class SportService extends BaseService
{

    /**
     * Get a list of sports
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('sports', $query);
        return $this->parseListResponse($response, Sport::class);
    }

    /**
     * Get a specific sport
     *
     * @param string $sportId
     * @return array
     */
    public function get(string $sportId): array
    {
        return $this->getById('sports', $sportId);
    }
}