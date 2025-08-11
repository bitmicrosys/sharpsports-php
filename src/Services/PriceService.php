<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Price;
use Bitmicrosys\SharpsportsPhp\Models\PriceResponse;

class PriceService extends BaseService
{


    /**
     * Get a list of prices
     * Note: Either 'eventId' or 'league' parameter is required
     * When using 'league', no other query params are valid
     *
     * @param array $query Query parameters (must include either 'eventId' or 'league')
     * @return array
     * @throws \Bitmicrosys\SharpsportsPhp\SharpsportsException
     */
    public function list(array $query = []): array
    {
        // Validate required parameters
        if (!isset($query['eventId']) && !isset($query['league'])) {
            throw new \Bitmicrosys\SharpsportsPhp\SharpsportsException(
                'Price API requires either eventId or league parameter'
            );
        }

        // The API restricts certain parameters based on what you're querying
        // When using league, no other parameters are allowed
        if (isset($query['league']) && count($query) > 1) {
            $query = ['league' => $query['league']];
        }

        $response = $this->client->get('prices', $query);

        // The price API returns an array of event objects with nested pricing data
        $priceResponses = [];

        if (is_array($response)) {
            foreach ($response as $item) {
                if (is_array($item)) {
                    $priceResponses[] = PriceResponse::fromArray($item);
                }
            }
        } elseif (is_string($response)) {
            // If we get a string response, it's likely an error message
            throw new \Bitmicrosys\SharpsportsPhp\SharpsportsException(
                'Price API returned unexpected response: ' . $response
            );
        }

        return $priceResponses;
    }

    /**
     * Get prices by event ID
     *
     * @param string $eventId
     * @param array $additionalParams Optional additional parameters
     * @return array
     */
    public function getByEvent(string $eventId, array $additionalParams = []): array
    {
        return $this->list(array_merge(['eventId' => $eventId], $additionalParams));
    }

    /**
     * Get prices by league
     * Note: No other parameters are allowed when using league
     *
     * @param string $league
     * @return array
     */
    public function getByLeague(string $league): array
    {
        return $this->list(['league' => $league]);
    }
}
