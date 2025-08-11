<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Market
{
    public string $id;
    public string $name;
    public string $type;
    public ?string $proposition;
    public ?bool $player;
    public ?bool $team;
    public ?bool $future;
    public ?string $oddsjamId;
    public ?string $sportradarId;
    public ?string $sportsdataioId;
    public ?string $theOddsApiId;
    public ?array $sport;
    public ?array $league;
    public ?array $segment;
    public ?array $metric;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->proposition = $data['proposition'] ?? null;
        $this->player = $data['player'] ?? null;
        $this->team = $data['team'] ?? null;
        $this->future = $data['future'] ?? null;
        $this->oddsjamId = $data['oddsjamId'] ?? null;
        $this->sportradarId = $data['sportradarId'] ?? null;
        $this->sportsdataioId = $data['sportsdataioId'] ?? null;
        $this->theOddsApiId = $data['theOddsApiId'] ?? null;
        $this->sport = $data['sport'] ?? null;
        $this->league = $data['league'] ?? null;
        $this->segment = $data['segment'] ?? null;
        $this->metric = $data['metric'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'proposition' => $this->proposition,
            'player' => $this->player,
            'team' => $this->team,
            'future' => $this->future,
            'oddsjamId' => $this->oddsjamId,
            'sportradarId' => $this->sportradarId,
            'sportsdataioId' => $this->sportsdataioId,
            'theOddsApiId' => $this->theOddsApiId,
            'sport' => $this->sport,
            'league' => $this->league,
            'segment' => $this->segment,
            'metric' => $this->metric,
        ];
    }

    public function getSportId(): ?string
    {
        return $this->sport['id'] ?? null;
    }

    public function getSportName(): ?string
    {
        return $this->sport['name'] ?? null;
    }

    public function getLeagueId(): ?string
    {
        return $this->league['id'] ?? null;
    }

    public function getLeagueName(): ?string
    {
        return $this->league['name'] ?? null;
    }

    public function getLeagueAbbr(): ?string
    {
        return $this->league['abbr'] ?? null;
    }

    public function getSegmentId(): ?string
    {
        return $this->segment['id'] ?? null;
    }

    public function getSegmentName(): ?string
    {
        return $this->segment['name'] ?? null;
    }

    public function getMetricId(): ?string
    {
        return $this->metric['id'] ?? null;
    }

    public function getMetricName(): ?string
    {
        return $this->metric['name'] ?? null;
    }

    public function isProp(): bool
    {
        return $this->type === 'prop';
    }

    public function isTotal(): bool
    {
        return $this->proposition === 'total';
    }

    public function isPlayerMarket(): bool
    {
        return $this->player === true;
    }

    public function isTeamMarket(): bool
    {
        return $this->team === true;
    }

    public function isFutureMarket(): bool
    {
        return $this->future === true;
    }
}