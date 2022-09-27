<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UrlTextHandler implements HandlerInterface
{
    private string $url;
    private HttpClientInterface $httpClient;

    public function __construct(string $url, HttpClientInterface $httpClient)
    {
        $this->url = $url;
        $this->httpClient = $httpClient;
    }

    public function prepareText()
    {
        $content = '';
        try {
            $response = $this->httpClient->request(
                Request::METHOD_GET,
                $this->url
            );
            if ($response->getStatusCode() > 200 && $response->getStatusCode() < 300) {
                $content = $response->getContent();
            }
        } catch (\Throwable $exception) {
            return $content;
        }
        return strip_tags($content);
    }
}
