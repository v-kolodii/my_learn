<?php

namespace App\Handler;

use Symfony\Component\Form\FormInterface;

interface HandlerFactoryInterface
{
    public function createHandler(FormInterface $form): HandlerInterface;
}
