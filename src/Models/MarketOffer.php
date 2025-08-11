<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class MarketOffer
{
    public string $id;
    public string $marketId;
    public string $bookId;
    public array $selections;
    public string $status;
    public ?string $validUntil;
    public ?array $metadata;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->marketId = $data['marketId'];
        $this->bookId = $data['bookId'];
        $this->selections = $data['selections'] ?? [];
        $this->status = $data['status'];
        $this->validUntil = $data['validUntil'] ?? null;
        $this->metadata = $data['metadata'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'marketId' => $this->marketId,
            'bookId' => $this->bookId,
            'selections' => $this->selections,
            'status' => $this->status,
            'validUntil' => $this->validUntil,
            'metadata' => $this->metadata,
        ];
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isExpired(): bool
    {
        if (!$this->validUntil) {
            return false;
        }
        return strtotime($this->validUntil) < time();
    }
}
