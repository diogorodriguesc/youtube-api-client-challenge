<?php declare(strict_types=1);

namespace App\Service\Google;

use App\Service\Authenticator;
use App\Service\DTO\Oauth;
use App\Service\Google\Exception\GoogleAuthenticationException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class OauthAuthenticator implements Authenticator
{
    private const REQUEST_ACCESS_TOKEN = 'https://accounts.google.com/o/oauth2/v2/auth';

    private $clientId;
    private $clientSecret;
    private $fileSystem;
    private $httpClient;

    public function __construct(
        HttpClientInterface $httpClient,
        FilesystemAdapter $fileSystem,
        string $clientId,
        string $clientSecret
    )
    {
        $this->httpClient = $httpClient;
        $this->fileSystem = $fileSystem;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @param false $refreshToken
     *
     * @return Oauth
     *
     * @throws GoogleAuthenticationException
     */
    public function oauth($refreshToken = false): Oauth
    {
        try {
            $googleOauth = $this->fileSystem->getItem('GOOGLE_OAUTH');
        } catch (InvalidArgumentException $exception) {
            $googleOauth = null;
        }

        if (null === $googleOauth || !$googleOauth->isHit() || $refreshToken)
        {
            $oauth = $this->authenticate();

            if (null === $googleOauth) {
                return $oauth;
            }

            $googleOauth->set(json_encode($oauth->toArray()));
            $this->fileSystem->save($googleOauth);
        }

        return Oauth::createFromArray((array) json_decode($googleOauth->get()));
    }

    /**
     * @return Oauth
     *
     * @throws GoogleAuthenticationException
     */
    private function authenticate(): Oauth
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                self::REQUEST_ACCESS_TOKEN,
                [
                    'query' => [
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret,
                        'response_type' => 'code',
                        'prompt' => 'consent',
                        'include_granted_scopes' => 'true',
                        'state' => 'state_parameter_passthrough_value',
                    ]
                ]
            );

            return Oauth::createFromArray((array) $response->getContent());
        } catch (Throwable $exception) {
            throw new GoogleAuthenticationException();
        }
    }
}