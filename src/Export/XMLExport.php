<?php

namespace App\Export;

use App\Entity\TextEntity;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class XMLExport implements ExportInterface
{
    private Environment $twig;
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    public function export(TextEntity $textEntity): Response
    {

        $response = new Response(
            $this->twig->render('statistic/xml.html.twig', ['textEntity' => $textEntity])
        );

        $response->headers->set('Content-type', 'text/xml');

        return $response;
    }
}