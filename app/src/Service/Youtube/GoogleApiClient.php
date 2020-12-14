<?php declare(strict_types=1);

namespace App\Service\Youtube;

use App\Service\Authenticator;
use App\Service\ClientInterface;
use App\Service\Google\Exception\GoogleAuthenticationException;
use App\Service\Youtube\Exception\ServerException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class GoogleApiClient implements ClientInterface
{
    private $authenticator;
    private $apiKey;
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient, Authenticator $authenticator, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->authenticator = $authenticator;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     *
     * @return ResponseInterface
     *
     * @throws ServerException
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $attempts = 0;

        try {
            $oauth = $this->authenticator->oauth();
            do {
                $options['headers']['Accept'] = 'application/json';
                $options['headers']['Authorization'] = sprintf('Bearer %s', $oauth->accessToken());
                $options['query']['key'] = $this->apiKey;

                $response = $this->httpClient->request($method, $url, $options);
                if ($response->getStatusCode() === 401) {
                    $oauth = $this->authenticator->oauth(true);
                }

                $attempts++;
            } while ($attempts <= 1 && $response->getStatusCode() === 401);

            return $response;
        } catch (TransportExceptionInterface $exception) {
            throw new ServerException($exception);
        } catch (GoogleAuthenticationException $exception) {
            throw new ServerException($exception);
        }
    }
}
