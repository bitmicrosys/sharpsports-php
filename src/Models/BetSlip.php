<?php

namespace Bitmicrosys\SharpsportsPhp\Models;

class BetSlip
{
    public string $id;
    public string $bettor;
    public array $book;
    public string $bettorAccount;
    public string $bookRef;
    public string $timePlaced;
    public string $type;
    public ?string $subtype;
    public ?float $oddsAmerican;
    public float $atRisk;
    public float $toWin;
    public string $status;
    public ?string $outcome;
    public ?string $refreshResponse;
    public ?bool $incomplete;
    public ?float $netProfit;
    public ?string $dateClosed;
    public ?string $timeClosed;
    public ?string $typeSpecial;
    public array $bets;
    public ?array $adjusted;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->bettor = $data['bettor'];
        $this->book = $data['book'];
        $this->bettorAccount = $data['bettorAccount'];
        $this->bookRef = $data['bookRef'];
        $this->timePlaced = $data['timePlaced'];
        $this->type = $data['type'];
        $this->subtype = $data['subtype'] ?? null;
        $this->oddsAmerican = isset($data['oddsAmerican']) ? (float) $data['oddsAmerican'] : null;
        $this->atRisk = (float) $data['atRisk'];
        $this->toWin = (float) $data['toWin'];
        $this->status = $data['status'];
        $this->outcome = $data['outcome'] ?? null;
        $this->refreshResponse = $data['refreshResponse'] ?? null;
        $this->incomplete = $data['incomplete'] ?? null;
        $this->netProfit = isset($data['netProfit']) ? (float) $data['netProfit'] : null;
        $this->dateClosed = $data['dateClosed'] ?? null;
        $this->timeClosed = $data['timeClosed'] ?? null;
        $this->typeSpecial = $data['typeSpecial'] ?? null;
        
        // Convert bet arrays to Bet objects
        $this->bets = [];
        if (isset($data['bets']) && is_array($data['bets'])) {
            foreach ($data['bets'] as $betData) {
                $this->bets[] = Bet::fromArray($betData);
            }
        }
        
        $this->adjusted = $data['adjusted'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'bettor' => $this->bettor,
            'book' => $this->book,
            'bettorAccount' => $this->bettorAccount,
            'bookRef' => $this->bookRef,
            'timePlaced' => $this->timePlaced,
            'type' => $this->type,
            'subtype' => $this->subtype,
            'oddsAmerican' => $this->oddsAmerican,
            'atRisk' => $this->atRisk,
            'toWin' => $this->toWin,
            'status' => $this->status,
            'outcome' => $this->outcome,
            'refreshResponse' => $this->refreshResponse,
            'incomplete' => $this->incomplete,
            'netProfit' => $this->netProfit,
            'dateClosed' => $this->dateClosed,
            'timeClosed' => $this->timeClosed,
            'typeSpecial' => $this->typeSpecial,
            'bets' => $this->bets,
            'adjusted' => $this->adjusted,
        ];
    }

    public function getBookId(): string
    {
        return $this->book['id'];
    }

    public function getBookName(): string
    {
        return $this->book['name'];
    }

    public function getBookAbbr(): string
    {
        return $this->book['abbr'];
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isWin(): bool
    {
        return $this->outcome === 'win';
    }

    public function isLoss(): bool
    {
        return $this->outcome === 'loss';
    }

    public function isPush(): bool
    {
        return $this->outcome === 'push';
    }

    public function isParlay(): bool
    {
        return $this->type === 'parlay';
    }

    public function isStraight(): bool
    {
        return $this->type === 'straight';
    }

    public function getFormattedTimePlaced(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($this->timePlaced));
    }

    public function getProfit(): float
    {
        if ($this->netProfit !== null) {
            return $this->netProfit;
        }
        
        if ($this->isWin()) {
            return $this->toWin;
        } elseif ($this->isLoss()) {
            return -$this->atRisk;
        }
        
        return 0.0;
    }
}