<?php

namespace Bitmicrosys\SharpsportsPhp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Bitmicrosys\SharpsportsPhp\Services\BookService books()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\BettorService bettors()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\BettorAccountService bettorAccounts()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\BetSlipService betSlips()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\ContextService context()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\EventService events()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\MarketService markets()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\SportService sports()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\LeagueService leagues()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\TeamService teams()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\PlayerService players()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\WebhookService webhooks()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\ArticleService articles()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\BookRegionService bookRegions()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\RefreshResponseService refreshResponses()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\PriceService prices()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\SegmentService segments()
 * @method static \Bitmicrosys\SharpsportsPhp\Services\MetricService metrics()
 * @method static \Bitmicrosys\SharpsportsPhp\Client getClient()
 * @method static void setApiKey(string $apiKey)
 * 
 * @see \Bitmicrosys\SharpsportsPhp\SharpSports
 */
class SharpSports extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sharpsports';
    }
}