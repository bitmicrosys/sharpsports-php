<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Player
{
    public string $id;
    public ?string $sportsdataioId;
    public ?string $oddsjamId;
    public ?string $sportradarId;
    public string $firstName;
    public string $lastName;
    public string $sportId;
    public string $fullName;
    public array $currentTeams;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->sportsdataioId = $data['sportsdataioId'] ?? null;
        $this->oddsjamId = $data['oddsjamId'] ?? null;
        $this->sportradarId = $data['sportradarId'] ?? null;
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->sportId = $data['sportId'];
        $this->fullName = $data['fullName'];
        $this->currentTeams = $data['currentTeams'] ?? [];
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'sportsdataioId' => $this->sportsdataioId,
            'oddsjamId' => $this->oddsjamId,
            'sportradarId' => $this->sportradarId,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'sportId' => $this->sportId,
            'fullName' => $this->fullName,
            'currentTeams' => $this->currentTeams,
        ];
    }

    public function getDisplayName(): string
    {
        return $this->fullName;
    }

    public function hasTeam(): bool
    {
        return count($this->currentTeams) > 0;
    }

    public function getTeamIds(): array
    {
        return array_map(function($team) {
            return $team['id'];
        }, $this->currentTeams);
    }

    public function getTeamNames(): array
    {
        return array_map(function($team) {
            return $team['fullName'];
        }, $this->currentTeams);
    }

    public function getPrimaryTeamId(): ?string
    {
        return isset($this->currentTeams[0]) ? $this->currentTeams[0]['id'] : null;
    }

    public function getPrimaryTeamName(): ?string
    {
        return isset($this->currentTeams[0]) ? $this->currentTeams[0]['fullName'] : null;
    }
}