<?php

namespace App\Controller\Api;

use App\Controller\Api\Traits\ApiHelperTrait;
use App\Form\Api\StringCheckType;
use App\Services\OxfordService;
use http\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DefaultApiController extends AbstractController
{

    use ApiHelperTrait;

    // Todo move lang to params or implement as params for request
    public const LANG = 'en-gb';

    public const DEFAULT_RESPONSE = ['id' => 'The Gods didn\'t allow this operation!'];


    /**
     * @Route("/entries", name="entries")
     * @param Request $request
     * @param LoggerInterface $apiLogger
     * @param HttpClientInterface $client
     * @param OxfordService $service
     * @return Response
     * @throws \Exception
     */
    public function entries(
        Request $request,
        LoggerInterface $apiLogger,
        HttpClientInterface $client,
        OxfordService $service
    ): Response {
        if ($request->isMethod(Request::METHOD_GET)) {
            return $this->getLuckyResponse();
        }

        try {
            $wordId = $this->getValidData($request, $apiLogger);
            $url = $service->getEntriesEndpoint() . self::LANG . '/' . $wordId;
            $response = $client->request(
                Request::METHOD_GET,
                $url,
                [
                    'headers' => [
                        'app_id' => $service->getApiId(),
                        'app_key' => $service->getApiKey(),
                    ],
                ]
            );

            $statusCode = $response->getStatusCode();
            $content = $response->toArray();
            $apiLogger->info(sprintf('Response: %s', $statusCode), $content);
        } catch (\Throwable $exception) {
            $apiLogger->error($exception->getMessage());
            $content = self::DEFAULT_RESPONSE;
        }
        return new JsonResponse([
            'content' => $content
        ], Response::HTTP_OK);
    }


    /**
     * @Route("/lemmas", name="lemmas")
     * @param Request $request
     * @param LoggerInterface $apiLogger
     * @param HttpClientInterface $client
     * @param OxfordService $service
     * @return Response
     * @throws \Exception
     */
    public function lemmas(
        Request $request,
        LoggerInterface $apiLogger,
        HttpClientInterface $client,
        OxfordService $service
    ): Response
    {
        if ($request->isMethod(Request::METHOD_GET)) {
            return $this->getLuckyResponse();
        }

        try {
            $wordId = $this->getValidData($request, $apiLogger);
            $url = $service->getLemmasEndpoint() . self::LANG . '/' . $wordId;
            $response = $client->request(
                Request::METHOD_GET,
                $url,
                [
                    'headers' => [
                        'app_id' => $service->getApiId(),
                        'app_key' => $service->getApiKey(),
                    ],
                ]
            );

            $statusCode = $response->getStatusCode();
            $content = $response->toArray();
            $apiLogger->info(sprintf('Response: %s', $statusCode), $content);
        } catch (\Throwable $exception) {
            $apiLogger->error($exception->getMessage());
            $content = self::DEFAULT_RESPONSE;
        }

        return new JsonResponse([
            'content' => $content
        ], Response::HTTP_OK);
    }
}
