<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\BettorAccount;

class BettorAccountService extends BaseService
{

    /**
     * Get a list of bettor accounts
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('bettorAccounts', $query);
        return $this->parseListResponse($response, BettorAccount::class);
    }

    /**
     * Get bettor accounts by bettor ID
     *
     * @param string $bettorId
     * @param array $query Optional query parameters
     * @return array
     */
    public function getByBettor(string $bettorId, array $query = []): array
    {
        $response = $this->client->get("bettors/{$bettorId}/bettorAccounts", $query);
        return $this->parseListResponse($response, BettorAccount::class);
    }

    /**
     * Get a specific bettor account
     *
     * @param string $accountId
     * @return array
     */
    public function get(string $accountId): array
    {
        return $this->getById('bettorAccounts', $accountId);
    }

    /**
     * Get bettor account metadata
     *
     * @param string $accountId
     * @return array
     */
    public function getAccountMetadata(string $accountId): array
    {
        return $this->getMetadata('bettorAccounts', $accountId);
    }

    /**
     * Refresh a bettor account
     *
     * @param string $accountId
     * @param array $data
     * @return array
     */
    public function refresh(string $accountId, array $data = []): array
    {
        return $this->client->post("bettorAccounts/{$accountId}/refresh", $data);
    }

    /**
     * Pause a bettor account
     *
     * @param string $accountId
     * @param array $data
     * @return array
     */
    public function pause(string $accountId, array $data = []): array
    {
        return $this->client->put("bettorAccounts/{$accountId}/pause", $data);
    }

    /**
     * Remove access to a bettor account
     *
     * @param string $accountId
     * @param array $data
     * @return array
     */
    public function removeAccess(string $accountId, array $data = []): array
    {
        return $this->client->put("bettorAccounts/{$accountId}/removeAccess", $data);
    }
}