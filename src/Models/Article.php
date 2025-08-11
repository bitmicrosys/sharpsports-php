<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Article
{
    public string $id;
    public string $timeCreated;
    public array $league;
    public string $s3Url;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->timeCreated = $data['timeCreated'];
        $this->league = $data['league'];
        $this->s3Url = $data['s3Url'];
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'timeCreated' => $this->timeCreated,
            'league' => $this->league,
            's3Url' => $this->s3Url,
        ];
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

    public function getFormattedTimeCreated(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($this->timeCreated));
    }
}
