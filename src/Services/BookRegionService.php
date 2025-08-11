<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\BookRegion;

class BookRegionService extends BaseService
{

    /**
     * Get a list of book regions
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('bookRegions', $query);
        return $this->parseListResponse($response, BookRegion::class);
    }

    /**
     * Get a specific book region
     *
     * @param string $regionId
     * @return array
     */
    public function get(string $regionId): array
    {
        return $this->getById('bookRegions', $regionId);
    }
}
