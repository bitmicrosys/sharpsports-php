<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class League
{
    public string $id;
    public ?string $sportsdataioId;
    public ?string $sportradarId;
    public ?string $region;
    public string $name;
    public ?string $abbr;
    public string $sportId;
    public ?string $oddsjamId;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->sportsdataioId = $data['sportsdataioId'] ?? null;
        $this->sportradarId = $data['sportradarId'] ?? null;
        $this->region = $data['region'] ?? null;
        $this->name = $data['name'];
        $this->abbr = $data['abbr'] ?? null;
        $this->sportId = $data['sportId'];
        $this->oddsjamId = $data['oddsjamId'] ?? null;
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
            'sportradarId' => $this->sportradarId,
            'region' => $this->region,
            'name' => $this->name,
            'abbr' => $this->abbr,
            'sportId' => $this->sportId,
            'oddsjamId' => $this->oddsjamId,
        ];
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbr;
    }

    public function getFullName(): string
    {
        if ($this->region) {
            return $this->region . ' - ' . $this->name;
        }
        return $this->name;
    }
}