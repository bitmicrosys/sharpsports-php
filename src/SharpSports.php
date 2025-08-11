<?php

namespace Bitmicrosys\SharpsportsPhp;

use Bitmicrosys\SharpsportsPhp\Services\BookService;
use Bitmicrosys\SharpsportsPhp\Services\BettorService;
use Bitmicrosys\SharpsportsPhp\Services\BettorAccountService;
use Bitmicrosys\SharpsportsPhp\Services\BetSlipService;
use Bitmicrosys\SharpsportsPhp\Services\ContextService;
use Bitmicrosys\SharpsportsPhp\Services\EventService;
use Bitmicrosys\SharpsportsPhp\Services\MarketService;
use Bitmicrosys\SharpsportsPhp\Services\SportService;
use Bitmicrosys\SharpsportsPhp\Services\LeagueService;
use Bitmicrosys\SharpsportsPhp\Services\TeamService;
use Bitmicrosys\SharpsportsPhp\Services\PlayerService;
use Bitmicrosys\SharpsportsPhp\Services\WebhookService;
use Bitmicrosys\SharpsportsPhp\Services\ArticleService;
use Bitmicrosys\SharpsportsPhp\Services\BookRegionService;
use Bitmicrosys\SharpsportsPhp\Services\RefreshResponseService;
use Bitmicrosys\SharpsportsPhp\Services\PriceService;
use Bitmicrosys\SharpsportsPhp\Services\SegmentService;
use Bitmicrosys\SharpsportsPhp\Services\MetricService;

class SharpSports
{
    protected Client $client;
    protected BookService $books;
    protected BettorService $bettors;
    protected BettorAccountService $bettorAccounts;
    protected BetSlipService $betSlips;
    protected ContextService $context;
    protected EventService $events;
    protected MarketService $markets;
    protected SportService $sports;
    protected LeagueService $leagues;
    protected TeamService $teams;
    protected PlayerService $players;
    protected WebhookService $webhooks;
    protected ArticleService $articles;
    protected BookRegionService $bookRegions;
    protected RefreshResponseService $refreshResponses;
    protected PriceService $prices;
    protected SegmentService $segments;
    protected MetricService $metrics;

    public function __construct(string $apiKey, array $options = [])
    {
        $this->client = new Client($apiKey, $options);
        $this->initializeServices();
    }

    /**
     * Initialize all service instances
     */
    protected function initializeServices(): void
    {
        $this->books = new BookService($this->client);
        $this->bettors = new BettorService($this->client);
        $this->bettorAccounts = new BettorAccountService($this->client);
        $this->betSlips = new BetSlipService($this->client);
        $this->context = new ContextService($this->client);
        $this->events = new EventService($this->client);
        $this->markets = new MarketService($this->client);
        $this->sports = new SportService($this->client);
        $this->leagues = new LeagueService($this->client);
        $this->teams = new TeamService($this->client);
        $this->players = new PlayerService($this->client);
        $this->webhooks = new WebhookService($this->client);
        $this->articles = new ArticleService($this->client);
        $this->bookRegions = new BookRegionService($this->client);
        $this->refreshResponses = new RefreshResponseService($this->client);
        $this->prices = new PriceService($this->client);
        $this->segments = new SegmentService($this->client);
        $this->metrics = new MetricService($this->client);
    }

    /**
     * Get the HTTP client instance
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Access book-related operations
     */
    public function books(): BookService
    {
        return $this->books;
    }

    /**
     * Access bettor-related operations
     */
    public function bettors(): BettorService
    {
        return $this->bettors;
    }

    /**
     * Access bettor account-related operations
     */
    public function bettorAccounts(): BettorAccountService
    {
        return $this->bettorAccounts;
    }

    /**
     * Access bet slip-related operations
     */
    public function betSlips(): BetSlipService
    {
        return $this->betSlips;
    }

    /**
     * Access context-related operations
     */
    public function context(): ContextService
    {
        return $this->context;
    }

    /**
     * Access event-related operations
     */
    public function events(): EventService
    {
        return $this->events;
    }

    /**
     * Access market-related operations
     */
    public function markets(): MarketService
    {
        return $this->markets;
    }

    /**
     * Access sport-related operations
     */
    public function sports(): SportService
    {
        return $this->sports;
    }

    /**
     * Access league-related operations
     */
    public function leagues(): LeagueService
    {
        return $this->leagues;
    }

    /**
     * Access team-related operations
     */
    public function teams(): TeamService
    {
        return $this->teams;
    }

    /**
     * Access player-related operations
     */
    public function players(): PlayerService
    {
        return $this->players;
    }

    /**
     * Access webhook-related operations
     */
    public function webhooks(): WebhookService
    {
        return $this->webhooks;
    }

    /**
     * Access article-related operations
     */
    public function articles(): ArticleService
    {
        return $this->articles;
    }

    /**
     * Access book region-related operations
     */
    public function bookRegions(): BookRegionService
    {
        return $this->bookRegions;
    }

    /**
     * Access refresh response-related operations
     */
    public function refreshResponses(): RefreshResponseService
    {
        return $this->refreshResponses;
    }

    /**
     * Access price-related operations
     */
    public function prices(): PriceService
    {
        return $this->prices;
    }

    /**
     * Access segment-related operations
     */
    public function segments(): SegmentService
    {
        return $this->segments;
    }

    /**
     * Access metric-related operations
     */
    public function metrics(): MetricService
    {
        return $this->metrics;
    }

    /**
     * Set a new API key
     */
    public function setApiKey(string $apiKey): void
    {
        $this->client->setApiKey($apiKey);
    }
}