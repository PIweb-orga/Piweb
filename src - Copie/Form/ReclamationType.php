<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Component\Validator\Constraints as CustomAssert;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ])
        ->add('description', TextType::class, [
            'attr' => [
                'placeholder' => 'Description',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce '
                ])
            ]
                ])
            ->add('typerec',ChoiceType::class,[
                'choices'=>[ 
                'facturation'=>'facturation',
                'qualite_nourriture'=>'qualite_nourriture',
                'service'=>'service'
                   ],
                   'placeholder' => 'Séléctionner type',
                   'constraints' => [
                       new NotBlank([
                           'message' => 'Ce champ est obligatoire'
                       ]), new CustomAssert\ValidType([
                        'message' => 'Le type doit être facturation, qualite_nourriture ou service'
                    ])

                   ]] )
            ->add('etatrec',ChoiceType::class,[
                'choices'=>[ 
                'en_attente'=>'en_attente',
                'en_cours'=>'en_cours',
                'resolue'=>'resolue'
                   ],
                   'placeholder' => 'Séléctionner type',
                   'constraints' => [
                       new NotBlank([
                           'message' => 'Ce champ est obligatoire'
                       ])
                   ]] )
            ->add('user', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'username',
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
