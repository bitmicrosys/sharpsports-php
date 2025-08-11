<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Metric;

class MetricService extends BaseService
{
    

    /**
     * Get a list of metrics
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('metrics', $query);
        return $this->parseListResponse($response, Metric::class);
    }

    /**
     * Get a specific metric
     *
     * @param string $metricId
     * @return array
     */
    public function get(string $metricId): array
    {
        return $this->getById('metrics', $metricId);
    }
}
