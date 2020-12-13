<?php declare(strict_types=1);

namespace App\Tests\Unit\UseCase\Query\GetYoutubeVideos\DTO;

use App\UseCase\Query\GetYoutubeVideos\DTO\Video;
use App\UseCase\Query\GetYoutubeVideos\DTO\Videos;
use PHPUnit\Framework\TestCase;

class VideosTest extends TestCase
{
    public function testVideosIsCreated(): void
    {
        $video1 = $this->createMock(Video::class);
        $video2 = $this->createMock(Video::class);
        $video3 = $this->createMock(Video::class);

        $videos = ((new Videos))->add($video1,$video2);
        $videos->add($video3);

        $this->assertCount(3, $videos);
    }
}
