<?php

namespace Bitmicrosys\SharpsportsPhp\Services;

use Bitmicrosys\SharpsportsPhp\Client;
use Bitmicrosys\SharpsportsPhp\Models\Article;

class ArticleService extends BaseService
{

    /**
     * Get a list of articles
     *
     * @param array $query Optional query parameters
     * @return array
     */
    public function list(array $query = []): array
    {
        $response = $this->client->get('articles', $query);
        return $this->parseListResponse($response, Article::class);
    }

    /**
     * Get a specific article
     *
     * @param string $articleId
     * @return array
     */
    public function get(string $articleId): array
    {
        return $this->getById('articles', $articleId);
    }
}
