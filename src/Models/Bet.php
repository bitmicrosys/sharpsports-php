<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Bet
{
    public string $id;
    public string $type;
    public array $event;
    public ?string $segment;
    public string $proposition;
    public ?string $segmentDetail;
    public string $position;
    public ?float $line;
    public ?float $oddsAmerican;
    public string $status;
    public ?string $outcome;
    public ?bool $live;
    public ?bool $incomplete;
    public ?string $bookDescription;
    public ?string $marketSelection;
    public ?bool $autoGrade;
    public ?string $segmentId;
    public ?string $positionId;
    public array $propDetails;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
        $this->event = $data['event'];
        $this->segment = $data['segment'] ?? null;
        $this->proposition = $data['proposition'];
        $this->segmentDetail = $data['segmentDetail'] ?? null;
        $this->position = $data['position'];
        $this->line = isset($data['line']) ? (float) $data['line'] : null;
        $this->oddsAmerican = isset($data['oddsAmerican']) ? (float) $data['oddsAmerican'] : null;
        $this->status = $data['status'];
        $this->outcome = $data['outcome'] ?? null;
        $this->live = $data['live'] ?? null;
        $this->incomplete = $data['incomplete'] ?? null;
        $this->bookDescription = $data['bookDescription'] ?? null;
        $this->marketSelection = $data['marketSelection'] ?? null;
        $this->autoGrade = $data['autoGrade'] ?? null;
        $this->segmentId = $data['segmentId'] ?? null;
        $this->positionId = $data['positionId'] ?? null;
        $this->propDetails = $data['propDetails'] ?? [];
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
            'segmentDetail' => $this->segmentDetail,
            'position' => $this->position,
            'line' => $this->line,
            'oddsAmerican' => $this->oddsAmerican,
            'status' => $this->status,
            'outcome' => $this->outcome,
            'live' => $this->live,
            'incomplete' => $this->incomplete,
            'bookDescription' => $this->bookDescription,
            'marketSelection' => $this->marketSelection,
            'autoGrade' => $this->autoGrade,
            'segmentId' => $this->segmentId,
            'positionId' => $this->positionId,
            'propDetails' => $this->propDetails,
        ];
    }

    public function getEventId(): string
    {
        return $this->event['id'];
    }

    public function getEventName(): string
    {
        return $this->event['name'];
    }

    public function getSport(): string
    {
        return $this->event['sport'];
    }

    public function getLeague(): string
    {
        return $this->event['league'];
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
}
