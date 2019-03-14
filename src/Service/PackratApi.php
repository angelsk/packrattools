<?php

namespace App\Service;

use App\Adapter\Adapter;
use function GuzzleHttp\json_decode;
use Psr\Http\Message\ResponseInterface;

class PackratApi
{
    const PACKRAT_API_URL = 'https://www.playpackrat.com/tools/';

    /**
     * @var Adapter
     */
    private $adapter;

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return ResponseInterface|null
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param int $collectionId
     *
     * @return array
     */
    public function getCollection(int $collectionId): array
    {
        $url = 'collection/'.$collectionId.'?api-token='.getenv('PACKRAT_API_KEY');

        $this->response = $this->adapter->get($url);

        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * @param int $cardId
     *
     * @return array
     */
    public function getCard(int $cardId): array
    {
        $url = 'kind/'.$cardId.'?api-token='.getenv('PACKRAT_API_KEY');

        $this->response = $this->adapter->get($url);

        return json_decode($this->response->getBody()->getContents(), true);
    }
}
