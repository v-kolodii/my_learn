<?php

declare(strict_types=1);

namespace App\Controller\Api\Traits;

use App\Form\Api\StringCheckType;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Trait ApiHelperTrait
 * @package App\Controller\Api\Traits
 */
trait ApiHelperTrait
{

    /**
     * Return form errors separated by comma
     *
     * @param FormInterface $form
     * @return array
     */
    protected function getFormErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface && $childErrors = $this->getFormErrors($childForm)) {
                $errors[$childForm->getName()] = $childErrors;
            }
        }

        return $errors;
    }


    /**
     * @param Request $request
     * @param LoggerInterface $apiLogger
     * @return string
     */
    public function getValidData(Request $request, LoggerInterface $apiLogger): string
    {
        $form = $this->createForm(StringCheckType::class);
        $wordId = strip_tags(strtolower($request->get('form-input', '')));
        $form->submit(['key' => $wordId]);
        if ($form->isSubmitted() && !$form->isValid()) {
            $apiLogger->error('Form errors', $this->getFormErrors($form));
            throw  new ValidatorException('Validation error');
        }

        return $wordId;
    }

    public function getLuckyResponse(): JsonResponse
    {
        return new JsonResponse([
            'Your lucky number is: ' => random_int(0, 10),
        ], Response::HTTP_OK);
    }

}