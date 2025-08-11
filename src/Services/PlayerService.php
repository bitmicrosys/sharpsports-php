<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Player;

class PlayerService extends BaseService
{
    

    /**
     * Get a list of players
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('players', $query);
        return $this->parseListResponse($response, Player::class);
    }

    /**
     * Get a specific player
     *
     * @param string $playerId
     * @return array
     */
    public function get(string $playerId): array
    {
        return $this->getById('players', $playerId);
    }
}