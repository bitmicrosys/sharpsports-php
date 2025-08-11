<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Bettor;

class BettorService extends BaseService
{

    /**
     * Get a list of bettors
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('bettors', $query);
        return $this->parseListResponse($response, Bettor::class);
    }

    /**
     * Get a specific bettor by ID
     *
     * @param string $bettorId
     * @return array
     */
    public function get(string $bettorId): array
    {
        return $this->getById('bettors', $bettorId);
    }

    /**
     * Get bettor metadata
     *
     * @param string $bettorId
     * @return array
     */
    public function getBettorMetadata(string $bettorId): array
    {
        return $this->getMetadata('bettors', $bettorId);
    }

    /**
     * Refresh a bettor's data
     *
     * @param string $bettorId
     * @param array $data
     * @return array
     */
    public function refresh(string $bettorId, array $data = []): array
    {
        return $this->client->post("bettors/{$bettorId}/refresh", $data);
    }
}