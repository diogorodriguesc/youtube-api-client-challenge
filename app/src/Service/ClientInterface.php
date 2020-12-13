<?php declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface ClientInterface
{
    public function request(string $method, string $url, array $options = []): ResponseInterface;
}