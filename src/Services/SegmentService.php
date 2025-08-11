<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Segment;

class SegmentService extends BaseService
{
    

    /**
     * Get a list of segments
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('segments', $query);
        return $this->parseListResponse($response, Segment::class);
    }

    /**
     * Get a specific segment
     *
     * @param string $segmentId
     * @return array
     */
    public function get(string $segmentId): array
    {
        return $this->getById('segments', $segmentId);
    }
}
