<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Bettor
{
    public string $id;
    public ?string $internalId;
    public ?bool $betRefreshRequested;
    public ?string $timeCreated;
    // Legacy fields that might exist
    public ?string $email;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $status;
    public ?string $createdAt;
    public ?string $updatedAt;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->internalId = $data['internalId'] ?? null;
        $this->betRefreshRequested = $data['betRefreshRequested'] ?? null;
        $this->timeCreated = $data['timeCreated'] ?? null;
        // Legacy fields
        $this->email = $data['email'] ?? null;
        $this->firstName = $data['firstName'] ?? null;
        $this->lastName = $data['lastName'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->createdAt = $data['createdAt'] ?? null;
        $this->updatedAt = $data['updatedAt'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }

    public function getFullName(): string
    {
        return trim(($this->firstName ?? '') . ' ' . ($this->lastName ?? ''));
    }
}