<?php

namespace App\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HandlerFactory implements HandlerFactoryInterface
{

    public HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->client = $httpClient;
    }

    public function createHandler(FormInterface $form): HandlerInterface
    {
        $file = $form->get('file')->getData();
        $url = $form->get('url')->getData();
        $text = $form->get('text')->getData();

        if($file){
            $handler = new FileHandler($file);
        } elseif ($url){
            $handler = new UrlTextHandler($url, $this->client);
        } elseif ($text){
            $handler = new TextHandler($text);
        } else {
            throw new \Exception('Form data not valid!');
        }
        return $handler;
    }

}