<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

/**
 * Represents the full response from the Prices API
 * which includes eventId and an array of markets with nested pricing data
 */
class PriceResponse
{
    public string $eventId;
    public array $markets;

    public function __construct(array $data)
    {
        $this->eventId = $data['eventId'];
        $this->markets = $data['markets'] ?? [];
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'eventId' => $this->eventId,
            'markets' => $this->markets,
        ];
    }

    /**
     * Get all market IDs
     */
    public function getMarketIds(): array
    {
        return array_map(function($market) {
            return $market['id'] ?? null;
        }, $this->markets);
    }

    /**
     * Get a specific market by ID
     */
    public function getMarket(string $marketId): ?array
    {
        foreach ($this->markets as $market) {
            if (($market['id'] ?? '') === $marketId) {
                return $market;
            }
        }
        return null;
    }

    /**
     * Get all market offers across all markets
     */
    public function getAllMarketOffers(): array
    {
        $offers = [];
        foreach ($this->markets as $market) {
            if (isset($market['marketOffers']) && is_array($market['marketOffers'])) {
                $offers = array_merge($offers, $market['marketOffers']);
            }
        }
        return $offers;
    }

    /**
     * Get all prices from all books
     */
    public function getAllPrices(): array
    {
        $prices = [];
        foreach ($this->markets as $market) {
            if (!isset($market['marketOffers'])) continue;

            foreach ($market['marketOffers'] as $offer) {
                if (!isset($offer['marketSelections'])) continue;

                foreach ($offer['marketSelections'] as $selection) {
                    if (!isset($selection['books'])) continue;

                    foreach ($selection['books'] as $book) {
                        if (!isset($book['prices'])) continue;

                        foreach ($book['prices'] as $price) {
                            $prices[] = [
                                'marketId' => $market['id'] ?? null,
                                'marketName' => $market['name'] ?? null,
                                'selectionId' => $selection['id'] ?? null,
                                'position' => $selection['position'] ?? null,
                                'bookId' => $book['id'] ?? null,
                                'bookName' => $book['name'] ?? null,
                                'bookAbbr' => $book['abbr'] ?? null,
                                'line' => $price['line'] ?? null,
                                'odds' => $price['odds'] ?? null,
                                'main' => $price['main'] ?? null,
                                'live' => $price['live'] ?? null,
                                'ev' => $price['ev'] ?? null,
                            ];
                        }
                    }
                }
            }
        }
        return $prices;
    }
}
