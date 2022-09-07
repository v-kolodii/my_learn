<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultApiController extends AbstractController
{
    /**
     * @Route("/number", name="number")
     * @return Response
     * @throws \Exception
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return new JsonResponse([
            'number' => $number,
        ], Response::HTTP_OK);
    }
}