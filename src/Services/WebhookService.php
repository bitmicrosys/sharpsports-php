<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;

class WebhookService extends BaseService
{
    

    /**
     * Subscribe to webhook endpoint
     *
     * @param array $data
     * @return array
     */
    public function subscribe(array $data): array
    {
        return $this->client->post('webhooks/subscribe', $data);
    }

    /**
     * Get webhook logs
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function getLogs(array $query = []): array
    {
        return $this->client->get('webhooks/logs', $query);
    }
}