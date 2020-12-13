<?php declare(strict_types=1);

namespace App\UseCase\Query\GetYoutubeVideos;

class Query
{
    private $searchValue;

    public function __construct(string $searchValue)
    {
        $this->searchValue = $searchValue;
    }

    public function searchValue(): string
    {
        return $this->searchValue;
    }
}
