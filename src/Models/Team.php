<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Team
{
    public string $id;
    public ?string $sportsdataioId;
    public ?string $oddsjamId;
    public ?string $sportradarId;
    public ?string $locale;
    public string $name;
    public string $fullName;
    public ?string $abbr;
    public string $sportId;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->sportsdataioId = $data['sportsdataioId'] ?? null;
        $this->oddsjamId = $data['oddsjamId'] ?? null;
        $this->sportradarId = $data['sportradarId'] ?? null;
        $this->locale = $data['locale'] ?? null;
        $this->name = $data['name'];
        $this->fullName = $data['fullName'];
        $this->abbr = $data['abbr'] ?? null;
        $this->sportId = $data['sportId'];
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
            'locale' => $this->locale,
            'name' => $this->name,
            'fullName' => $this->fullName,
            'abbr' => $this->abbr,
            'sportId' => $this->sportId,
        ];
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getDisplayName(): string
    {
        if ($this->locale) {
            return $this->locale . ' ' . $this->name;
        }
        return $this->fullName;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbr;
    }
}