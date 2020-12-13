<?php declare(strict_types=1);

namespace App\UseCase\Query\GetYoutubeVideos\DTO;

use ArrayIterator;

class Videos extends ArrayIterator
{
    public function add(Video ...$videos): self
    {
        foreach ($videos as $video) {
            parent::append($video);
        }

        return $this;
    }
}
