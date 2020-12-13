<?php declare(strict_types=1);

namespace App\Service\Youtube;

use App\Service\ClientInterface;
use App\Service\Youtube\Exception\NotFoundException;
use App\Service\Youtube\Exception\ServerException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class GoogleApiClient implements ClientInterface
{
    private $accessToken;
    private $apiKey;
    private $client;

    public function __construct(HttpClientInterface $client, string $accessToken, string $apiKey)
    {
        $this->client = $client;
        $this->accessToken = $accessToken;
        $this->apiKey = $apiKey;
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        try {
            $options['headers']['Accept'] = 'application/json';
            $options['headers']['Authorization'] = sprintf('Bearer %s', $this->accessToken);
            $options['query']['key'] = $this->apiKey;

            return $this->client->request($method, $url, $options);
        } catch (TransportExceptionInterface $exception) {
            throw new ServerException($exception);
        } catch (RedirectionExceptionInterface $exception) {
            throw new ServerException($exception);
        } catch (ClientExceptionInterface $exception) {
            throw new NotFoundException($exception);
        } catch (ServerExceptionInterface $exception) {
            throw new ServerException($exception);
        }
    }
}
