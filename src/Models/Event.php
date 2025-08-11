<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Event
{
    public string $id;
    public string $name;
    public string $sport;
    public ?string $league;
    public ?string $nameSpecial;
    public string $startTime;
    public ?string $startDate;
    public ?string $seasonType;
    public string $sportId;
    public ?string $leagueId;
    public ?array $contestantAway;
    public ?array $contestantHome;
    public ?bool $neutralVenue;
    public ?string $sportsdataioId;
    public ?string $sportradarId;
    public ?string $oddsjamId;
    public ?string $theOddsApiId;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->sport = $data['sport'];
        $this->league = $data['league'] ?? null;
        $this->nameSpecial = $data['nameSpecial'] ?? null;
        $this->startTime = $data['startTime'];
        $this->startDate = $data['startDate'] ?? null;
        $this->seasonType = $data['seasonType'] ?? null;
        $this->sportId = $data['sportId'];
        $this->leagueId = $data['leagueId'] ?? null;
        $this->contestantAway = $data['contestantAway'] ?? null;
        $this->contestantHome = $data['contestantHome'] ?? null;
        $this->neutralVenue = $data['neutralVenue'] ?? null;
        $this->sportsdataioId = $data['sportsdataioId'] ?? null;
        $this->sportradarId = $data['sportradarId'] ?? null;
        $this->oddsjamId = $data['oddsjamId'] ?? null;
        $this->theOddsApiId = $data['theOddsApiId'] ?? null;
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
            'sport' => $this->sport,
            'league' => $this->league,
            'nameSpecial' => $this->nameSpecial,
            'startTime' => $this->startTime,
            'startDate' => $this->startDate,
            'seasonType' => $this->seasonType,
            'sportId' => $this->sportId,
            'leagueId' => $this->leagueId,
            'contestantAway' => $this->contestantAway,
            'contestantHome' => $this->contestantHome,
            'neutralVenue' => $this->neutralVenue,
            'sportsdataioId' => $this->sportsdataioId,
            'sportradarId' => $this->sportradarId,
            'oddsjamId' => $this->oddsjamId,
            'theOddsApiId' => $this->theOddsApiId,
        ];
    }

    public function isUpcoming(): bool
    {
        return strtotime($this->startTime) > time();
    }

    public function isPast(): bool
    {
        return strtotime($this->startTime) < time();
    }

    public function getHomeTeamName(): ?string
    {
        return $this->contestantHome['fullName'] ?? null;
    }

    public function getAwayTeamName(): ?string
    {
        return $this->contestantAway['fullName'] ?? null;
    }

    public function getFormattedStartTime(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($this->startTime));
    }

    public function hasTeams(): bool
    {
        return !is_null($this->contestantHome) && !is_null($this->contestantAway);
    }
}
