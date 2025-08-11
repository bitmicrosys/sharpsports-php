<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Book
{
    public string $id;
    public string $name;
    public string $abbr;
    public string $status;
    public bool $refreshCadenceActive;
    public bool $sdkRequired;
    public ?string $pullBackToDate;
    public ?int $maxHistoryMonths;
    public ?int $maxHistoryBets;
    public ?string $historyDetail;
    public bool $mobileOnly;
    public ?array $sdkSupport;
    public ?bool $oddsFeedActive;
    public array $betPlaceStatus;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->abbr = $data['abbr'];
        $this->status = $data['status'];
        $this->refreshCadenceActive = $data['refreshCadenceActive'];
        $this->sdkRequired = $data['sdkRequired'];
        $this->pullBackToDate = $data['pullBackToDate'] ?? null;
        $this->maxHistoryMonths = $data['maxHistoryMonths'] ?? null;
        $this->maxHistoryBets = $data['maxHistoryBets'] ?? null;
        $this->historyDetail = $data['historyDetail'] ?? null;
        $this->mobileOnly = $data['mobileOnly'] ?? false;
        $this->sdkSupport = $data['sdkSupport'] ?? null;
        $this->oddsFeedActive = $data['oddsFeedActive'] ?? null;
        $this->betPlaceStatus = $data['betPlaceStatus'] ?? [];
    }

    /**
     * Create a Book instance from API response data
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert the book to an array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'abbr' => $this->abbr,
            'status' => $this->status,
            'refreshCadenceActive' => $this->refreshCadenceActive,
            'sdkRequired' => $this->sdkRequired,
            'pullBackToDate' => $this->pullBackToDate,
            'maxHistoryMonths' => $this->maxHistoryMonths,
            'maxHistoryBets' => $this->maxHistoryBets,
            'historyDetail' => $this->historyDetail,
            'mobileOnly' => $this->mobileOnly,
            'sdkSupport' => $this->sdkSupport,
            'oddsFeedActive' => $this->oddsFeedActive,
            'betPlaceStatus' => $this->betPlaceStatus,
        ];
    }

    /**
     * Check if the book is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the book requires SDK
     */
    public function requiresSdk(): bool
    {
        return $this->sdkRequired;
    }

    /**
     * Check if refresh cadence is active
     */
    public function hasRefreshCadence(): bool
    {
        return $this->refreshCadenceActive;
    }

    /**
     * Get bet place status for a specific platform
     */
    public function getBetPlaceStatus(string $platform): ?string
    {
        return $this->betPlaceStatus[$platform] ?? null;
    }
}