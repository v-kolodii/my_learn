<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class OxfordService
{
    private string $apiId;
    private string $apiUrl;
    private string $apiKey;
    private string $entries = 'entries';
    private string $lemmas = 'lemmas';

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->apiId = $parameterBag->get('oxford_client_id');
        $this->apiUrl = $parameterBag->get('oxford_endpoint_url');
        $this->apiKey = $parameterBag->get('oxford_secret_key');
    }


    /**
     * @return string
     */
    public function getApiId(): string
    {
        return $this->apiId;
    }


    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }


    /**
     * @return string
     */
    public function getApiEndpoint(): string
    {
        return $this->apiUrl;
    }


    /**
     * @return string
     */
    public function getEntriesEndpoint(): string
    {
        return $this->apiUrl . $this->entries . '/';
    }

    /**
     * @return string
     */
    public function getLemmasEndpoint(): string
    {
        return $this->apiUrl . $this->lemmas . '/';
    }

}