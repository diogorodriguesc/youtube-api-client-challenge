<?php declare(strict_types=1);

namespace App\Service\DTO;

final class Oauth
{
    private $accessToken;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->setAccessToken($data['accessToken']);

        return $self;
    }

    public function accessToken(): string
    {
        return $this->accessToken;
    }

    public function toArray(): array
    {
        return [
            'accessToken' => $this->accessToken(),
        ];
    }

    private function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }
}