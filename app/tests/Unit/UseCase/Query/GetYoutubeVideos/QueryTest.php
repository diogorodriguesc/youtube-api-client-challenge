<?php declare(strict_types=1);

namespace App\Tests\Unit\UseCase\Query\GetYoutubeVideos;

use App\UseCase\Query\GetYoutubeVideos\Query;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    public function testQueryIsCreated(): void
    {
        $query = new Query('some-search-value');
        $this->assertEquals('some-search-value', $query->searchValue());
    }
}
