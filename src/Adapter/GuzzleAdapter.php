<?php

namespace App\Adapter;

use App\Service\PackratApi;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter implements Adapter
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $baseUri
     *
     * @return self
     */
    public static function create(string $baseUri = PackratApi::PACKRAT_API_URL): self 
    {
        $client = new Client(
            [
                'base_uri' => $baseUri,
                'headers' => [
                    'User-Agent' => 'Packrat Tools - Market Tracker - API v2.0',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]
        );

        return new self($client);
    }

    /**
     * @inheritdoc
     */
    public function get(string $url): ResponseInterface
    {
        return $this->client->request('GET', $url);
    }

    /**
     * @inheritdoc
     */
    public function post(string $url, array $content = []): ResponseInterface
    {
        return $this->client->request('POST', $url, ['json' => $content]);
    }

    /**
     * @inheritdoc
     */
    public function put(string $url, array $content = []): ResponseInterface
    {
        return $this->client->request('PUT', $url, ['json' => $content]);
    }

    /**
     * @inheritdoc
     */
    public function delete(string $url): ResponseInterface
    {
        return $this->client->request('DELETE', $url);
    }
}
