<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datepar', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('numero', TextType::class, [
                'attr' => [
                    'placeholder' => 'Numero',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le numero. '
                    ])
                ]
                    ])
            ->add('event', EntityType::class, [
                'class' => 'App\Entity\Evennement', // Replace with the actual entity class name
                'choice_label' => 'titre', // Display the 'titre' property of the 'Evennement' entity
            ])
           
            ->add('user', EntityType::class, [
                'class' => 'App\Entity\User', // Replace with the actual entity class name
                'choice_label' => 'username', // Display the 'titre' property of the 'Evennement' entity
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}