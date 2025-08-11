<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class Price
{
    public string $id;
    public string $marketSelectionId;
    public string $bookId;
    public float $odds;
    public string $format;
    public string $timestamp;
    public bool $isActive;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->marketSelectionId = $data['marketSelectionId'];
        $this->bookId = $data['bookId'];
        $this->odds = (float) $data['odds'];
        $this->format = $data['format'] ?? 'decimal';
        $this->timestamp = $data['timestamp'];
        $this->isActive = $data['isActive'] ?? true;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'marketSelectionId' => $this->marketSelectionId,
            'bookId' => $this->bookId,
            'odds' => $this->odds,
            'format' => $this->format,
            'timestamp' => $this->timestamp,
            'isActive' => $this->isActive,
        ];
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getAmericanOdds(): int
    {
        if ($this->odds >= 2.0) {
            return (int) (($this->odds - 1) * 100);
        } else {
            return (int) (-100 / ($this->odds - 1));
        }
    }

    public function getFractionalOdds(): string
    {
        $decimal = $this->odds - 1;
        // Simple conversion to fraction (could be more sophisticated)
        if ($decimal < 1) {
            $numerator = 1;
            $denominator = (int) (1 / $decimal);
        } else {
            $numerator = (int) $decimal;
            $denominator = 1;
        }
        return "{$numerator}/{$denominator}";
    }
}
