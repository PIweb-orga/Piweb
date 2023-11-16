<?php

namespace App\Form;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'placeholder' => 'Nom',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir le  nom. '
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
           ->add('image', FileType::class, [ 
            'label'=>'image',
            'required' => false,
            'mapped' => false])
            ->add('prix', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prix',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le prix. '
                    ])
                ]
                    ])
            ->add('categorie',ChoiceType::class,[
                'choices'=>[ 
                    'Dessert'=>'Dessert',
                   'Pizza'=>'Pizza',
                   'Boissons'=>'Boissons',
                   'Berger'=>'Berger'
                          ],
                    'placeholder' => 'Séléctionner type',
                      'constraints' => [
                    new NotBlank([
                      'message' => 'Veuiller choisir la categorie'
                      ])
                          ]] )
               ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
