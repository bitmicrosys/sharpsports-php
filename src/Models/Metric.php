<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Metric
{
    public string $id;
    public string $name;
    public ?string $category;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->category = $data['category'] ?? null;
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
            'category' => $this->category,
        ];
    }

    public function isPoints(): bool
    {
        return $this->id === 'METR_points';
    }

    public function isAssists(): bool
    {
        return $this->id === 'METR_assists';
    }

    public function isRebounds(): bool
    {
        return $this->id === 'METR_rebounds';
    }

    public function isPassingYards(): bool
    {
        return $this->id === 'METR_passyds';
    }

    public function isRushingYards(): bool
    {
        return $this->id === 'METR_rushyds';
    }

    public function isReceivingYards(): bool
    {
        return $this->id === 'METR_recyds';
    }

    public function isTouchdowns(): bool
    {
        return $this->id === 'METR_touchdowns';
    }

    public function isHits(): bool
    {
        return $this->id === 'METR_hits';
    }

    public function isHomeRuns(): bool
    {
        return $this->id === 'METR_homeruns';
    }

    public function isStrikeouts(): bool
    {
        return $this->id === 'METR_strikeouts';
    }

    public function isGoals(): bool
    {
        return $this->id === 'METR_goals';
    }

    public function isAces(): bool
    {
        return $this->id === 'METR_aces';
    }
}