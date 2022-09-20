<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     * @throws \Exception
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'entries_endpoint' => $this->generateUrl('api.entries', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'lemmas_endpoint' => $this->generateUrl('api.lemmas', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
    }
}