<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class MarketSelection
{
    public string $id;
    public string $type;
    public array $event;
    public ?string $segment;
    public string $proposition;
    public string $position;
    public string $marketId;
    public string $marketName;
    public string $marketOfferId;
    public array $sportsdataio;
    public array $sportradar;
    public array $oddsjam;
    public array $theOddsApi;
    public ?string $segmentId;
    public ?string $positionId;
    public array $propDetails;
    public array $betPlaceAvailability;
    public array $betPlaceUrls;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
        $this->event = $data['event'];
        $this->segment = $data['segment'] ?? null;
        $this->proposition = $data['proposition'];
        $this->position = $data['position'];
        $this->marketId = $data['marketId'];
        $this->marketName = $data['marketName'];
        $this->marketOfferId = $data['marketOfferId'];
        $this->sportsdataio = $data['sportsdataio'] ?? [];
        $this->sportradar = $data['sportradar'] ?? [];
        $this->oddsjam = $data['oddsjam'] ?? [];
        $this->theOddsApi = $data['theOddsApi'] ?? [];
        $this->segmentId = $data['segmentId'] ?? null;
        $this->positionId = $data['positionId'] ?? null;
        $this->propDetails = $data['propDetails'] ?? [];
        $this->betPlaceAvailability = $data['betPlaceAvailability'] ?? [];
        $this->betPlaceUrls = $data['betPlaceUrls'] ?? [];
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'event' => $this->event,
            'segment' => $this->segment,
            'proposition' => $this->proposition,
            'position' => $this->position,
            'marketId' => $this->marketId,
            'marketName' => $this->marketName,
            'marketOfferId' => $this->marketOfferId,
            'sportsdataio' => $this->sportsdataio,
            'sportradar' => $this->sportradar,
            'oddsjam' => $this->oddsjam,
            'theOddsApi' => $this->theOddsApi,
            'segmentId' => $this->segmentId,
            'positionId' => $this->positionId,
            'propDetails' => $this->propDetails,
            'betPlaceAvailability' => $this->betPlaceAvailability,
            'betPlaceUrls' => $this->betPlaceUrls,
        ];
    }

    public function getEventId(): string
    {
        return $this->event['id'];
    }

    public function getEventName(): string
    {
        return $this->event['name'] ?? '';
    }

    public function getSport(): string
    {
        return $this->event['sport'] ?? '';
    }

    public function getLeague(): string
    {
        return $this->event['league'] ?? '';
    }

    public function isProp(): bool
    {
        return $this->type === 'prop';
    }

    public function isTotal(): bool
    {
        return $this->proposition === 'total';
    }

    public function isSpread(): bool
    {
        return $this->proposition === 'spread';
    }

    public function isMoneyline(): bool
    {
        return $this->proposition === 'moneyline';
    }

    public function getPlayerName(): ?string
    {
        return $this->propDetails['player'] ?? null;
    }

    public function getPlayerId(): ?string
    {
        return $this->propDetails['playerId'] ?? null;
    }

    public function getMetricSpecial(): ?string
    {
        return $this->propDetails['metricSpecial'] ?? null;
    }

    public function isFuture(): bool
    {
        return ($this->propDetails['future'] ?? 0) === 1;
    }

    public function isAvailableAt(string $bookAbbr): bool
    {
        return !empty($this->betPlaceAvailability[$bookAbbr] ?? false);
    }

    public function getBetPlaceUrl(string $bookAbbr): ?string
    {
        return $this->betPlaceUrls[$bookAbbr] ?? null;
    }
}