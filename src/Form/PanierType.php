<?php

namespace App\Form;

use App\Entity\Achat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', IntegerType::class)
            ->add('prix', IntegerType::class)
            ->add('user', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'username',
            ])
            ->add('plat', EntityType::class, [
                'class' => 'App\Entity\Plat',
                'choice_label' => 'nom',
            ])
            ->add('montantTotal', TextType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'readonly' => true,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
        ]);
    }
}
