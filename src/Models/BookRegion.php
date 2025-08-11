<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class BookRegion
{
    public string $id;
    public array $book;
    public string $name;
    public string $abbr;
    public string $status;
    public string $country;
    public bool $mobileOnly;
    public bool $sdkRequired;
    public ?array $sdkSupport;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->book = $data['book'];
        $this->name = $data['name'];
        $this->abbr = $data['abbr'];
        $this->status = $data['status'];
        $this->country = $data['country'];
        $this->mobileOnly = $data['mobileOnly'] ?? false;
        $this->sdkRequired = $data['sdkRequired'] ?? false;
        $this->sdkSupport = $data['sdkSupport'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'book' => $this->book,
            'name' => $this->name,
            'abbr' => $this->abbr,
            'status' => $this->status,
            'country' => $this->country,
            'mobileOnly' => $this->mobileOnly,
            'sdkRequired' => $this->sdkRequired,
            'sdkSupport' => $this->sdkSupport,
        ];
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getBookId(): ?string
    {
        return $this->book['id'] ?? null;
    }

    public function getBookName(): ?string
    {
        return $this->book['name'] ?? null;
    }

    public function requiresSdk(): bool
    {
        return $this->sdkRequired;
    }
}
