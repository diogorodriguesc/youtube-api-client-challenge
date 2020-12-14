<?php declare(strict_types=1);

namespace App\Service;

use App\Service\DTO\Oauth;
use App\Service\Google\Exception\GoogleAuthenticationException;

interface Authenticator
{
    /**
     * @throws GoogleAuthenticationException
     */
    public function oauth(): Oauth;
}