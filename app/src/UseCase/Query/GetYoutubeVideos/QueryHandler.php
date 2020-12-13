<?php

namespace App\UseCase\Query\GetYoutubeVideos;

use App\UseCase\Query\GetYoutubeVideos\DTO\Video;
use App\UseCase\Query\GetYoutubeVideos\DTO\Videos;

class QueryHandler
{
    public function __construct()
    {

    }

    public function handle(Query $query): Videos
    {
        return ((new Videos())->add(new Video('title1'), new Video('title2')));
    }
}