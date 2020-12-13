<?php declare(strict_types=1);

namespace App\UseCase\Query\GetYoutubeVideos;

use App\Service\SearchProviderInterface;
use App\UseCase\Query\GetYoutubeVideos\DTO\Video;
use App\UseCase\Query\GetYoutubeVideos\DTO\Videos;

class QueryHandler
{
    private $videoSearchProvider;

    public function __construct(SearchProviderInterface $videoSearchProvider)
    {
        $this->videoSearchProvider = $videoSearchProvider;
    }

    public function handle(Query $query): Videos
    {
        $results = $this->videoSearchProvider->search($query->searchValue());

        return ((new Videos())->add(new Video('title1'), new Video('title2')));
    }
}
