<?php

namespace App\Controller;

use App\Entity\TextEntity;
use App\Entity\TextEntityDTO;
use App\Export\ExportFactory;
use App\Form\TextEntityType;
use App\Handler\HandlerFactory;
use App\Repository\TextEntityRepository;
use App\Service\StatisticService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/number", name="number")
     * @return Response
     * @throws \Exception
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('number.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @param StatisticService $statisticService
     * @param HttpClientInterface $httpClient
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, StatisticService $statisticService, HttpClientInterface $httpClient): Response
    {
        $textEntityDTO = new TextEntityDTO();
        $form = $this->createForm(TextEntityType::class, $textEntityDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $factory = new HandlerFactory($httpClient);
            $text = $factory->createHandler($form)->prepareText();
            $textEntity = $statisticService->createNewTextStatistic($text);
            $this->updateSession($request, $textEntity);

            return $this->redirectToRoute('statistic', ['textEntity' => $textEntity->getId()]);
        }

        return $this->renderForm('statistic/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/statistic/{textEntity}", name="statistic")
     * @param Request $request
     * @param TextEntity $textEntity
     * @return Response
     * @throws \Exception
     */
    public function statistic(Request $request, TextEntity $textEntity): Response
    {
        return $this->render('statistic/view.html.twig', [
            'textEntity' => $textEntity,
        ]);
    }

    /**
     * @Route("/export/{type}", name="export")
     * @param Request $request
     * @param string $type
     * @return Response
     * @throws \Exception
     */
    public function export(Request $request, string $type, TextEntityRepository $repository, LoggerInterface $logger): Response
    {
        $id = $request->query->get('id');
        try {
            if ($id && $textEntity = $repository->findOneBy(['id' => $id])) {
            $exporter = ExportFactory::createExport($type);
            return $exporter->export($textEntity);
            }
        } catch (\Exception $e){
          $logger->error($e->getMessage());
        }
        return  $this->redirectToRoute('new');
    }

    /**
     * @Route("/last-10", name="last_10")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function last10(Request $request, EntityManagerInterface $em): Response
    {
        $session = $request->getSession();
        $value = $session->get('last10', '');

        $textEntities = $em->getRepository(TextEntity::class)->findByHash($value);

        if (empty($textEntities)) {
            throw $this->createNotFoundException('The product does not exist');
        }

        return $this->render('statistic/last.html.twig', [
            'textEntities' => $textEntities,
        ]);
    }

    protected function updateSession(Request &$request, TextEntity $textEntity)
    {
        $session = $request->getSession();
        $value = $session->get('last10', '');
        $value = $value . $textEntity->getHash() . ',';
        $session->set('last10', $value);
        $request->setSession($session);
    }
}