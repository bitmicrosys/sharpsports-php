<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Segment
{
    public string $id;
    public string $name;
    public ?string $abbr;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->abbr = $data['abbr'] ?? null;
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
            'abbr' => $this->abbr,
        ];
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbr;
    }

    public function isFullGame(): bool
    {
        return $this->id === 'SEGM_M';
    }

    public function isFirstHalf(): bool
    {
        return $this->id === 'SEGM_1H';
    }

    public function isSecondHalf(): bool
    {
        return $this->id === 'SEGM_2H';
    }

    public function isFirstQuarter(): bool
    {
        return $this->id === 'SEGM_1Q';
    }

    public function isSecondQuarter(): bool
    {
        return $this->id === 'SEGM_2Q';
    }

    public function isThirdQuarter(): bool
    {
        return $this->id === 'SEGM_3Q';
    }

    public function isFourthQuarter(): bool
    {
        return $this->id === 'SEGM_4Q';
    }
}