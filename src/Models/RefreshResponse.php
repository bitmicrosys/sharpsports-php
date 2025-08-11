<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class RefreshResponse
{
    public string $id;
    public array $bettorAccount;
    public string $timeCreated;
    public $status; // Can be numeric or string
    public ?string $detail;
    public ?string $requestId;
    public ?string $type;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->bettorAccount = $data['bettorAccount'];
        $this->timeCreated = $data['timeCreated'];
        $this->status = $data['status'];
        $this->detail = $data['detail'] ?? null;
        $this->requestId = $data['requestId'] ?? null;
        $this->type = $data['type'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'bettorAccount' => $this->bettorAccount,
            'timeCreated' => $this->timeCreated,
            'status' => $this->status,
            'detail' => $this->detail,
            'requestId' => $this->requestId,
            'type' => $this->type,
        ];
    }

    public function isSuccess(): bool
    {
        return $this->status === 'success' || $this->status === 200 || $this->status === '200';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed' || ($this->status >= 400 && $this->status < 600);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
    
    public function getBettorAccountId(): string
    {
        return $this->bettorAccount['id'];
    }
    
    public function getBettorId(): string
    {
        return $this->bettorAccount['bettor'];
    }
    
    public function getBookId(): string
    {
        return $this->bettorAccount['book']['id'] ?? '';
    }
    
    public function getBookName(): string
    {
        return $this->bettorAccount['book']['name'] ?? '';
    }

    public function getFormattedTimeCreated(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($this->timeCreated));
    }
}