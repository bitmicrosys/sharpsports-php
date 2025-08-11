<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\League;

class LeagueService extends BaseService
{
    

    /**
     * Get a list of leagues
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('leagues', $query);
        return $this->parseListResponse($response, League::class);
    }

    /**
     * Get a specific league
     *
     * @param string $leagueId
     * @return array
     */
    public function get(string $leagueId): array
    {
        return $this->getById('leagues', $leagueId);
    }
}