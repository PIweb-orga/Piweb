<?php

namespace App\Form;

use App\Entity\Badge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class BadgeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commantaire', null, [
                'constraints' => [
                    new NotBlank(['message' => 'commantaire Avis should not be blank.']),
                ],
            ])
            
            ->add('typebadge',ChoiceType::class,[
                'choices'=>[ 
                'Diamant'=>'Diamant',
                'Silver'=>'Silver',
                'VIP'=>'VIP'
                   ]] )
                   ->add('user', EntityType::class, [
                    'class' => 'App\Entity\User',
                    'choice_label' => 'username',
                ])
                ->add('restaurant', EntityType::class, [
                    'class' => 'App\Entity\Restaurant',
                    'choice_label' => 'nom',
                ]);
    }



    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Badge::class,
        ]);
    }
}
