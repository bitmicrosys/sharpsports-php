# SharpSports PHP Laravel SDK (Unofficial)

[![Latest Stable Version](https://poser.pugx.org/bitmicrosys/sharpsports-php/v)](https://packagist.org/packages/bitmicrosys/sharpsports-php)
[![Total Downloads](https://poser.pugx.org/bitmicrosys/sharpsports-php/downloads)](https://packagist.org/packages/bitmicrosys/sharpsports-php)
[![License](https://poser.pugx.org/bitmicrosys/sharpsports-php/license)](https://packagist.org/packages/bitmicrosys/sharpsports-php)

Hey there! 👋 This is an **unofficial** PHP/Laravel SDK for the [SharpSports API](https://docs.sharpsports.io/). Threw this together in a few hours because I needed it for a project. It works pretty well, but you know... it's not perfect.

## ⚠️ Disclaimer

This is **NOT** an official SharpSports product. I'm just some dev who needed to integrate their API. Use at your own risk! If something breaks, don't blame me (or SharpSports). If you find bugs, just open an issue or better yet, submit a PR!

## Features

- ✅ Covers most (all?) SharpSports API endpoints
- ✅ Laravel service provider and facade (fancy!)
- ✅ Model classes that make sense
- ✅ Handles those weird API responses pretty well
- ✅ Error handling that actually works
- ✅ Probably won't break your app (no promises though)

## Installation

Install the package via Composer:

```bash
composer require bitmicrosys/sharpsports-php
```

### Laravel Auto-Discovery

The package supports Laravel's auto-discovery feature. If you're using Laravel 5.5+, the service provider and facade will be automatically registered.

### Manual Registration (Laravel < 5.5)

Add the service provider to your `config/app.php`:

```php
'providers' => [
    // ...
    Bitmicrosys\SharpsportsPhp\SharpsportsServiceProvider::class,
],
```

Add the facade to your `config/app.php`:

```php
'aliases' => [
    // ...
    'SharpSports' => Bitmicrosys\SharpsportsPhp\Facades\SharpSports::class,
],
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=sharpsports-config
```

Add your SharpSports API key to your `.env` file:

```env
SHARPSPORTS_API_KEY=your_api_key_here
```

## Usage

### Basic Usage

```php
use Bitmicrosys\SharpsportsPhp\SharpSports;

// Initialize the client
$sharpSports = new SharpSports('your_api_key');

// Get all books
$books = $sharpSports->books()->list();

// Get active books only
$activeBooks = $sharpSports->books()->getActive();
```

### Using Laravel Facade

```php
use SharpSports;

// Get all books
$books = SharpSports::books()->list();

// Get a specific book
$book = SharpSports::books()->find('BOOK_pPg9ABaPSj2mL6qoMTKR1A');

// Get bettors
$bettors = SharpSports::bettors()->list();

// Get bet slips for a bettor
$betSlips = SharpSports::betSlips()->getByBettor('bettor_id');
```

### Using Dependency Injection

```php
use Bitmicrosys\SharpsportsPhp\SharpSports;

class BettingController extends Controller
{
    public function __construct(private SharpSports $sharpSports)
    {
        //
    }

    public function getBooks()
    {
        return $this->sharpSports->books()->getActive();
    }
}
```

## Complete API Coverage

The SharpSports PHP SDK provides comprehensive coverage of all SharpSports API endpoints:

### Books
```php
// Get all books
$books = $sharpSports->books()->list();

// Get active books
$activeBooks = $sharpSports->books()->getActive();

// Get books that require SDK
$sdkBooks = $sharpSports->books()->getSdkRequired();

// Find a specific book
$book = $sharpSports->books()->find('BOOK_ID');
```

### Bettors
```php
// Get all bettors
$bettors = $sharpSports->bettors()->list();

// Get bettor details
$bettor = $sharpSports->bettors()->get('bettor_id');

// Get bettor metadata
$metadata = $sharpSports->bettors()->getMetadata('bettor_id');

// Refresh bettor data
$response = $sharpSports->bettors()->refresh('bettor_id');
```

### Bettor Accounts
```php
// Get all bettor accounts
$accounts = $sharpSports->bettorAccounts()->list();

// Get accounts for a specific bettor
$accounts = $sharpSports->bettorAccounts()->getByBettor('bettor_id');

// Refresh an account
$response = $sharpSports->bettorAccounts()->refresh('account_id');

// Pause an account
$response = $sharpSports->bettorAccounts()->pause('account_id');
```

### Bet Slips
```php
// Get all bet slips
$betSlips = $sharpSports->betSlips()->list();

// Get bet slips for a bettor
$betSlips = $sharpSports->betSlips()->getByBettor('bettor_id');

// Get bet slips for an account
$betSlips = $sharpSports->betSlips()->getByBettorAccount('account_id');

// Check bet slip availability
$availability = $sharpSports->betSlips()->checkAvailability($data);
```

### Context Operations
```php
// Sync bets
$response = $sharpSports->context()->betSync($data);

// Place bets
$response = $sharpSports->context()->betPlace($data);

// Get best price
$response = $sharpSports->context()->bestPrice($data);
```

### Events, Markets, Sports, etc.
```php
// Events
$events = $sharpSports->events()->list();
$event = $sharpSports->events()->get('event_id');

// Markets
$markets = $sharpSports->markets()->list();
$market = $sharpSports->markets()->get('market_id');

// Sports
$sports = $sharpSports->sports()->list();
$sport = $sharpSports->sports()->get('sport_id');

// Leagues
$leagues = $sharpSports->leagues()->list();

// Teams
$teams = $sharpSports->teams()->list();

// Players
$players = $sharpSports->players()->list();
```

### Webhooks
```php
// Subscribe to webhooks
$response = $sharpSports->webhooks()->subscribe($data);

// Get webhook logs
$logs = $sharpSports->webhooks()->getLogs();
```

## Model Classes

The SDK includes model classes for type-safe responses:

```php
use Bitmicrosys\SharpsportsPhp\Models\Book;

$books = $sharpSports->books()->list();

foreach ($books as $book) {
    echo $book->name; // BetMGM
    echo $book->abbr; // mg
    echo $book->isActive(); // true/false
    echo $book->requiresSdk(); // true/false
}
```

Available models:
- `Book`
- `Bettor`
- `BettorAccount`
- `BetSlip`

## Error Handling

The SDK throws `SharpsportsException` for API errors:

```php
use Bitmicrosys\SharpsportsPhp\SharpsportsException;

try {
    $books = $sharpSports->books()->list();
} catch (SharpsportsException $e) {
    echo "API Error: " . $e->getMessage();
    echo "Status Code: " . $e->getCode();
}
```

## Configuration Options

You can customize the HTTP client by passing options to the constructor:

```php
$sharpSports = new SharpSports('your_api_key', [
    'timeout' => 60,
    'connect_timeout' => 10,
    'headers' => [
        'User-Agent' => 'MyApp/1.0',
    ],
]);
```

## All Available Methods

### Complete API Coverage

The SDK provides complete coverage of all SharpSports API objects:

- 📖 **Books** - Sportsbook information and status
- 📝 **Articles** - AI-generated SEO articles  
- 🌎 **BookRegions** - Regional sportsbook availability
- 👤 **Bettors** - User accounts and profiles
- 📱 **BettorAccounts** - Connected sportsbook accounts
- 💰 **BetSlips** - Betting history and slips
- 🔄 **RefreshResponses** - Account refresh status
- 🎟️ **Events** - Sports events and games
- 📋 **Markets** - Betting markets
- 🏷️ **MarketSelections** - Market options
- 🛒 **MarketOffers** - Available offers
- 🏛️ **Prices** - Odds and pricing
- 🏈 **Sports** - Available sports
- 🏟️ **Leagues** - Sports leagues
- 🎽 **Teams** - Sports teams
- ⛹️‍♂️ **Players** - Player information
- 🕞 **Segments** - Market segments
- 🧮 **Metrics** - Performance metrics
- 🔗 **Context** - Bet placement context
- 🪝 **Webhooks** - Event subscriptions

Each service provides standard methods like `list()`, `get()`, and specialized methods for specific functionality.

## Error Handling

```php
use Bitmicrosys\SharpsportsPhp\SharpsportsException;

try {
    $books = $sharpSports->books()->list();
} catch (SharpsportsException $e) {
    echo "API Error: " . $e->getMessage();
    echo "Status Code: " . $e->getCode();
}
```

## Contributing

Found a bug? Cool, fix it and send a PR. Want to add something? Go for it! This is open source, baby! 🚀

## Known Issues

- Price API returns different response structures depending on parameters (single object vs array). Yeah, it's weird, but we handle it.
- Some endpoints need specific parameters or they'll yell at you
- Haven't tested everything extensively (who has time for that?)
- Probably other stuff I haven't found yet

## License

This package is open-sourced software licensed under the [MIT license](LICENSE). See the license file for the full "I'm not responsible for anything" legal text.

## Support

Having issues? Open a GitHub issue. Want to chat? Sorry, I'm probably coding. But seriously, just open an issue and I'll try to help when I can.

## Credits

- SharpSports for having an API (even though their docs could be better 😅)
- Coffee for keeping me awake while coding this
- Stack Overflow for... you know why

## API Documentation

For the official API docs (good luck understanding them sometimes), visit [SharpSports API Reference](https://docs.sharpsports.io/reference/book).

---

**Remember**: This is unofficial. If SharpSports changes their API and this breaks, well... ¯\_(ツ)_/¯