<?php

namespace App\UseCase\Query\GetYoutubeVideos\DTO;

use ArrayIterator;

class Videos extends ArrayIterator
{
    private $list;

    public function add(Video ...$videos): self
    {
        foreach ($videos as $video) {
            parent::append($video);
        }

        return $this;
    }
}