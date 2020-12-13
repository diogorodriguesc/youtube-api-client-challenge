<?php

namespace App\Tests\Unit\UseCase\Query\GetYoutubeVideos\DTO;

use App\UseCase\Query\GetYoutubeVideos\DTO\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testVideoIsCreated(): void
    {
        $video = new Video('some-video-title');
        $this->assertEquals('some-video-title', $video->title());
    }
}