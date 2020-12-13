<?php

namespace App\UseCase\Query\GetYoutubeVideos\DTO;

class Video
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }
}