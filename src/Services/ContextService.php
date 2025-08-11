<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;

class ContextService extends BaseService
{
    

    /**
     * Sync bets using context
     *
     * @param array $data
     * @return array
     */
    public function betSync(array $data): array
    {
        return $this->client->post('context/bet-sync', $data);
    }

    /**
     * Place bets using context
     *
     * @param array $data
     * @return array
     */
    public function betPlace(array $data): array
    {
        return $this->client->post('context/bet-place', $data);
    }

    /**
     * Get best price using context
     *
     * @param array $data
     * @return array
     */
    public function bestPrice(array $data): array
    {
        return $this->client->post('context/best-price', $data);
    }
}