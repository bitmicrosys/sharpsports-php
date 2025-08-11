<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Team;

class TeamService extends BaseService
{
    

    /**
     * Get a list of teams
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('teams', $query);
        return $this->parseListResponse($response, Team::class);
    }

    /**
     * Get a specific team
     *
     * @param string $teamId
     * @return array
     */
    public function get(string $teamId): array
    {
        return $this->getById('teams', $teamId);
    }
}