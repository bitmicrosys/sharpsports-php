<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bitmicrosys\SharpsportsPhp\SharpSports;
use Bitmicrosys\SharpsportsPhp\SharpsportsException;

// Initialize the SharpSports client
$apiKey = 'your_api_key_here';
$sharpSports = new SharpSports($apiKey);

try {
    // Example 1: Get all available books
    echo "=== Available Books ===\n";
    $books = $sharpSports->books()->list();
    
    foreach ($books as $book) {
        echo sprintf(
            "ID: %s | Name: %s | Status: %s | SDK Required: %s\n",
            $book->id,
            $book->name,
            $book->status,
            $book->requiresSdk() ? 'Yes' : 'No'
        );
    }
    
    // Example 2: Get only active books
    echo "\n=== Active Books ===\n";
    $activeBooks = $sharpSports->books()->getActive();
    
    foreach ($activeBooks as $book) {
        echo sprintf(
            "%s (%s) - Refresh Cadence: %s\n",
            $book->name,
            $book->abbr,
            $book->hasRefreshCadence() ? 'Yes' : 'No'
        );
    }
    
    // Example 3: Get bettors (if you have any)
    echo "\n=== Bettors ===\n";
    $bettors = $sharpSports->bettors()->list();
    
    if (empty($bettors)) {
        echo "No bettors found.\n";
    } else {
        foreach ($bettors as $bettor) {
            echo sprintf(
                "ID: %s | Email: %s | Name: %s\n",
                $bettor->id,
                $bettor->email,
                $bettor->getFullName()
            );
        }
    }
    
    // Example 4: Get events
    echo "\n=== Recent Events ===\n";
    $events = $sharpSports->events()->list(['limit' => 5]);
    
    if (isset($events['data'])) {
        foreach ($events['data'] as $event) {
            echo sprintf(
                "Event: %s\n",
                $event['name'] ?? 'Unknown Event'
            );
        }
    } else {
        echo "No events found.\n";
    }
    
    // Example 5: Get sports
    echo "\n=== Available Sports ===\n";
    $sports = $sharpSports->sports()->list();
    
    if (isset($sports['data'])) {
        foreach ($sports['data'] as $sport) {
            echo sprintf(
                "Sport: %s\n",
                $sport['name'] ?? 'Unknown Sport'
            );
        }
    } else {
        echo "No sports found.\n";
    }
    
} catch (SharpsportsException $e) {
    echo "SharpSports API Error: " . $e->getMessage() . "\n";
    echo "Status Code: " . $e->getCode() . "\n";
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage() . "\n";
}

echo "\nDone!\n";