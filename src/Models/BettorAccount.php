<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class BettorAccount
{
    public string $id;
    public string $bettorId;
    public string $bookId;
    public string $status;
    public ?string $username;
    public string $createdAt;
    public string $updatedAt;
    public ?string $lastRefreshAt;
    public ?array $metadata;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->bettorId = $data['bettorId'];
        $this->bookId = $data['bookId'];
        $this->status = $data['status'];
        $this->username = $data['username'] ?? null;
        $this->createdAt = $data['createdAt'];
        $this->updatedAt = $data['updatedAt'];
        $this->lastRefreshAt = $data['lastRefreshAt'] ?? null;
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
            'bettorId' => $this->bettorId,
            'bookId' => $this->bookId,
            'status' => $this->status,
            'username' => $this->username,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'lastRefreshAt' => $this->lastRefreshAt,
            'metadata' => $this->metadata,
        ];
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['verified', 'active']);
    }
}