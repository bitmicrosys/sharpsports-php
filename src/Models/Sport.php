<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Sport
{
    public string $id;
    public string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
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
        ];
    }

    public function isFootball(): bool
    {
        return $this->id === 'SPRT_americanfootball';
    }

    public function isBaseball(): bool
    {
        return $this->id === 'SPRT_baseball';
    }

    public function isBasketball(): bool
    {
        return $this->id === 'SPRT_basketball';
    }

    public function isHockey(): bool
    {
        return $this->id === 'SPRT_hockey';
    }

    public function isSoccer(): bool
    {
        return $this->id === 'SPRT_soccer';
    }

    public function isTennis(): bool
    {
        return $this->id === 'SPRT_tennis';
    }

    public function isGolf(): bool
    {
        return $this->id === 'SPRT_golf';
    }

    public function isMma(): bool
    {
        return $this->id === 'SPRT_mma';
    }

    public function isBoxing(): bool
    {
        return $this->id === 'SPRT_boxing';
    }
}