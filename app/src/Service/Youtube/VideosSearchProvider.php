<?php declare(strict_types=1);

namespace App\Service\Youtube;

use App\Service\ClientInterface;
use App\Service\SearchProviderInterface;

final class VideosSearchProvider implements SearchProviderInterface
{
    private const SEARCH_ENDPOINT_URI = 'https://www.googleapis.com/youtube/v3/search';

    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function search(string $query): array
    {
        $response = $this->client->request(
            'GET',
            self::SEARCH_ENDPOINT_URI,
            [
                'query' => [
                    'q' => $query,
                    'part' => [
                        'snippet',
                        'id'
                    ]
                ]
            ]
        );

        $results = [];
        $content = $response->getContent();

        foreach ($content->items as $item) {
            if ($item->id->kind != 'youtube#video') {
                continue;
            }

            $snippet = $item->snippet;
            $results[] = [
                'id'            => $item->id->videoId,
                'title'         => $snippet->title,
                'description'   => $snippet->description,
                'published_at'  => $snippet->publishedAt,
            ];
        }

        return $results;
    }
}