<?php declare(strict_types=1);

namespace App\Service;

interface SearchProviderInterface
{
    public function search(string $query): array;
}