<?php

namespace App\Controller;

use App\UseCase\Query\GetYoutubeVideos\Query;
use App\UseCase\Query\GetYoutubeVideos\DTO\Videos;
use League\Tactician\CommandBus;

class GetYoutubeVideosController
{
    private $queryBus;

    public function __construct(CommandBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function getYoutubeVideos(string $searchValue): Videos
    {
        return $this->queryBus->handle(new Query($searchValue));
    }
}