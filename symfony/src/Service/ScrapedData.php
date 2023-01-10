<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ScrapedData
{
    private $client;
    public function __construct(HttpClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
    }

    public function getScrapedData()
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:9080/crawl.json?spider_name=oscaro&url=https://www.oscaro.com/filtre-dhabitacle-424-g'
        );

        // $statusCode = $response->getStatusCode();

        // $contentType = $response->getHeaders()['content-type'][0];

        // $content = $response->getContent();

        $content = $response->toArray();


        // $decoded = json_decode($response);
        return     $response;
    }
}
