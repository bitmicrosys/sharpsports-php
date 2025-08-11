<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Book;

class BookService extends BaseService
{

    /**
     * Get a list of all available books
     *
     * @param array $query Optional query parameters
     * @return Book[]
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('books', $query);
        return $this->parseListResponse($response, Book::class);
    }

    /**
     * Get a specific book by ID
     *
     * @param string $bookId
     * @return Book|null
     */
    public function get(string $bookId): array
    {
        return $this->getById('books', $bookId);
    }
    
    /**
     * Find a book by ID from the list
     */
    public function find(string $bookId): ?Book
    {
        try {
            $data = $this->get($bookId);
            return Book::fromArray($data);
        } catch (\Exception $e) {
            // If not found via detail endpoint, try from list
            $books = $this->list();
            foreach ($books as $book) {
                if ($book->id === $bookId) {
                    return $book;
                }
            }
            return null;
        }
    }

    /**
     * Get books by status
     *
     * @param string $status
     * @return Book[]
     */
    public function getByStatus(string $status): array
    {
        return $this->list(['status' => $status]);
    }

    /**
     * Get active books only
     *
     * @return Book[]
     */
    public function getActive(): array
    {
        return $this->getByStatus('active');
    }

    /**
     * Get books that support SDK
     *
     * @return Book[]
     */
    public function getSdkRequired(): array
    {
        $books = $this->list();
        
        return array_filter($books, function (Book $book) {
            return $book->sdkRequired;
        });
    }

    /**
     * Get books that support refresh cadence
     *
     * @return Book[]
     */
    public function getWithRefreshCadence(): array
    {
        $books = $this->list();
        
        return array_filter($books, function (Book $book) {
            return $book->refreshCadenceActive;
        });
    }
}