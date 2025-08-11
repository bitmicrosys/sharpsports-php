<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Market;
use Bitmicrosys\SharpsportsPhp\Models\MarketSelection;
use Bitmicrosys\SharpsportsPhp\Models\MarketOffer;
use Bitmicrosys\SharpsportsPhp\Models\Price;

class MarketService extends BaseService
{

    /**
     * Get a list of markets
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('markets', $query);
        return $this->parseListResponse($response, Market::class);
    }

    /**
     * Get a specific market
     *
     * @param string $marketId
     * @return array
     */
    public function get(string $marketId): array
    {
        return $this->getById('markets', $marketId);
    }

    /**
     * Get market selections
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function getSelections(array $query = []): array
    {
        $response = $this->client->get('marketSelections', $query);
        return $this->parseListResponse($response, MarketSelection::class);
    }

    /**
     * Get a specific market selection
     *
     * @param string $selectionId
     * @return array
     */
    public function getSelection(string $selectionId): array
    {
        return $this->getById('marketSelections', $selectionId);
    }

    /**
     * Get market selection metadata
     *
     * @param string $selectionId
     * @return array
     */
    public function getSelectionMetadata(string $selectionId): array
    {
        return $this->getMetadata('marketSelections', $selectionId);
    }

    /**
     * Get market selection historic data
     *
     * @param string $selectionId
     * @param array $query Optional query parameters
     * @return array
     */
    public function getSelectionHistoricData(string $selectionId, array $query = []): array
    {
        return $this->client->get("marketSelections/{$selectionId}/historicData", $query);
    }

    /**
     * Get market offers
     * Note: Requires at least one of: eventId, sdioEventId, sportradarEventId, oddsjamEventId, theOddsApiEventId
     *
     * @param array $query Query parameters (must include at least one event identifier)
     * @return array
     * @throws \Bitmicrosys\SharpsportsPhp\SharpsportsException
     */
    public function getOffers(array $query = []): array
    {
        // Validate required parameters
        $eventParams = ['eventId', 'sdioEventId', 'sportradarEventId', 'oddsjamEventId', 'theOddsApiEventId'];
        $hasEventParam = false;
        foreach ($eventParams as $param) {
            if (isset($query[$param])) {
                $hasEventParam = true;
                break;
            }
        }
        
        if (!$hasEventParam) {
            throw new \Bitmicrosys\SharpsportsPhp\SharpsportsException(
                'MarketOffer API requires at least one of the following parameters: ' . implode(', ', $eventParams)
            );
        }
        
        $response = $this->client->get('marketOffers', $query);
        return $this->parseListResponse($response, MarketOffer::class);
    }

    /**
     * Get a specific market offer
     *
     * @param string $offerId
     * @return array
     */
    public function getOffer(string $offerId): array
    {
        return $this->getById('marketOffers', $offerId);
    }

    /**
     * Get prices
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function getPrices(array $query = []): array
    {
        $response = $this->client->get('prices', $query);
        return $this->parseListResponse($response, Price::class);
    }
}