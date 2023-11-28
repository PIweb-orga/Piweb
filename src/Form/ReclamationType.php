<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ])
            ->add('description')
            ->add('typerec',ChoiceType::class,[
                'choices'=>[ 
                'facturation'=>'facturation',
                'qualite_nourriture'=>'qualite_nourriture',
                'service'=>'service'
                   ]] )
            ->add('etatrec',ChoiceType::class,[
                'choices'=>[ 
                'en_attente'=>'en_attente',
                'en_cours'=>'en_cours',
                'resolue'=>'resolue'
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
