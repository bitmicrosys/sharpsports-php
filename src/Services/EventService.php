<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Event;

class EventService extends BaseService
{
    

    /**
     * Get a list of events
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('events', $query);
        
        $events = [];
        // Events API returns a direct array, not wrapped in 'data'
        if (is_array($response)) {
            foreach ($response as $eventData) {
                if (is_array($eventData)) {
                    $events[] = Event::fromArray($eventData);
                }
            }
        }
        
        return $events;
    }

    /**
     * Get a specific event
     *
     * @param string $eventId
     * @return array
     */
    public function get(string $eventId): array
    {
        return $this->getById('events', $eventId);
    }
}