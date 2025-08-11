<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\BetSlip;

class BetSlipService extends BaseService
{

    /**
     * Get a list of bet slips
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('betSlips', $query);
        return $this->parseListResponse($response, BetSlip::class);
    }

    /**
     * Get a specific bet slip
     *
     * @param string $betSlipId
     * @return array
     */
    public function get(string $betSlipId): array
    {
        return $this->getById('betSlips', $betSlipId);
    }

    /**
     * Get bet slips by bettor account
     *
     * @param string $accountId
     * @param array $query Optional query parameters
     * @return array
     */
    public function getByBettorAccount(string $accountId, array $query = []): array
    {
        $response = $this->client->get("bettorAccounts/{$accountId}/betSlips", $query);
        return $this->parseListResponse($response, BetSlip::class);
    }

    /**
     * Get bet slips by bettor
     *
     * @param string $bettorId
     * @param array $query Optional query parameters
     * @return array
     */
    public function getByBettor(string $bettorId, array $query = []): array
    {
        $response = $this->client->get("bettors/{$bettorId}/betSlips", $query);
        return $this->parseListResponse($response, BetSlip::class);
    }

    /**
     * Check bet slip availability
     *
     * @param array $data
     * @return array
     */
    public function checkAvailability(array $data): array
    {
        return $this->client->get('betSlips/availability', $data);
    }
}