<?php

namespace App\Form;

use App\Entity\Evennement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;

class EvennementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une Titre. '
                    ])
                ]
                    ])
            ->add('description', TextType::class, [
                'attr' => [
                    'placeholder' => 'Description',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une description. '
                    ])
                ]
                    ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('img', FileType::class, [ 
                'label'=>'image',
                'required' => false,
                'mapped' => false])
            ->add('lieu', TextType::class, [
                'attr' => [
                    'placeholder' => 'lieu',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une lieu. '
                    ])
                ]
                    ])
            
            ->add('adresse', TextType::class, [
                'attr' => [
                    'placeholder' => 'adresse',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une adresse. '
                    ])
                ]
                    ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evennement::class,
        ]);
    }
}
