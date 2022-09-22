<?php

namespace App\Form;

use App\Entity\TextEntityDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TextEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, [
                'label' => 'URL: ',
                'mapped' => false,
                'required' => false,
            ])
            ->add('text', TextareaType::class, [
                'label' => 'TEXT: ',
                'mapped' => false,
                'required' => false,
            ])
            ->add('file', FileType::class, [
                'label' => 'FILE: ',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'text/plain',
                            'text/html',
                            'application/xml',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid (TXT, HTML OR XML) document',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TextEntityDTO::class,
        ]);
    }
}
