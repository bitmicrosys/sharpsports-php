<?php

/**
 * Example Laravel Controller using the SharpSports SDK
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use SharpSports; // Using the facade
use Bitmicrosys\SharpsportsPhp\SharpsportsException;

class BettingController extends Controller
{
    /**
     * Get all available sportsbooks
     */
    public function getBooks(): JsonResponse
    {
        try {
            $books = SharpSports::books()->getActive();
            
            return response()->json([
                'success' => true,
                'data' => collect($books)->map(function ($book) {
                    return [
                        'id' => $book->id,
                        'name' => $book->name,
                        'abbr' => $book->abbr,
                        'status' => $book->status,
                        'sdk_required' => $book->requiresSdk(),
                        'refresh_cadence' => $book->hasRefreshCadence(),
                        'bet_place_status' => $book->betPlaceStatus,
                    ];
                })
            ]);
        } catch (SharpsportsException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Get bettor information
     */
    public function getBettor(string $bettorId): JsonResponse
    {
        try {
            $bettor = SharpSports::bettors()->get($bettorId);
            
            return response()->json([
                'success' => true,
                'data' => $bettor
            ]);
        } catch (SharpsportsException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Get bet slips for a bettor
     */
    public function getBetSlips(string $bettorId): JsonResponse
    {
        try {
            $betSlips = SharpSports::betSlips()->getByBettor($bettorId);
            
            return response()->json([
                'success' => true,
                'data' => collect($betSlips)->map(function ($betSlip) {
                    return [
                        'id' => $betSlip->id,
                        'amount' => $betSlip->amount,
                        'potential_payout' => $betSlip->potentialPayout,
                        'status' => $betSlip->status,
                        'type' => $betSlip->type,
                        'placed_at' => $betSlip->placedAt,
                        'settled_at' => $betSlip->settledAt,
                        'is_settled' => $betSlip->isSettled(),
                        'is_win' => $betSlip->isWin(),
                    ];
                })
            ]);
        } catch (SharpsportsException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Get available events
     */
    public function getEvents(Request $request): JsonResponse
    {
        try {
            $query = $request->only(['sport', 'league', 'date', 'limit']);
            $events = SharpSports::events()->list($query);
            
            return response()->json([
                'success' => true,
                'data' => $events
            ]);
        } catch (SharpsportsException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Refresh bettor account data
     */
    public function refreshBettorAccount(string $accountId): JsonResponse
    {
        try {
            $response = SharpSports::bettorAccounts()->refresh($accountId);
            
            return response()->json([
                'success' => true,
                'message' => 'Refresh initiated successfully',
                'data' => $response
            ]);
        } catch (SharpsportsException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    /**
     * Subscribe to webhooks
     */
    public function subscribeWebhook(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'url' => 'required|url',
                'events' => 'required|array',
                'events.*' => 'string'
            ]);
            
            $response = SharpSports::webhooks()->subscribe($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Webhook subscription created',
                'data' => $response
            ]);
        } catch (SharpsportsException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
}