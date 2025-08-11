<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\RefreshResponse;

class RefreshResponseService extends BaseService
{

    /**
     * Get a list of refresh responses
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('refreshResponses', $query);
        return $this->parseListResponse($response, RefreshResponse::class);
    }

    /**
     * Get refresh responses by bettor account
     *
     * @param string $accountId
     * @param array $query Optional query parameters
     * @return array
     */
    public function getByBettorAccount(string $accountId, array $query = []): array
    {
        $response = $this->client->get("bettorAccounts/{$accountId}/refreshResponses", $query);
        return $this->parseListResponse($response, RefreshResponse::class);
    }

    /**
     * Get refresh responses by bettor
     *
     * @param string $bettorId
     * @param array $query Optional query parameters
     * @return array
     */
    public function getByBettor(string $bettorId, array $query = []): array
    {
        $response = $this->client->get("bettors/{$bettorId}/refreshResponses", $query);
        return $this->parseListResponse($response, RefreshResponse::class);
    }

    /**
     * Get a specific refresh response
     *
     * @param string $responseId
     * @return array
     */
    public function get(string $responseId): array
    {
        return $this->getById('refreshResponses', $responseId);
    }
}
