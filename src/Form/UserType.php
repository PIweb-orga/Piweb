<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;


class UserType extends AbstractType
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('username', TextType::class, [
            'attr' => [
                'placeholder' => 'Username',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir un username. '
                ])
            ]
                ])
        ->add('email', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Email',
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir le mail. '
                        ])
                    ]
                        ])
        
        ->add('password', TextType::class, [
            'attr' => [
                'placeholder' => 'Password',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir password. '
                ])
            ]
                ])
        
        ->add('firstname', TextType::class, [
            'attr' => [
                'placeholder' => 'Firstname',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir firstname. '
                ])
            ]
                ])
        
        ->add('lastname', TextType::class, [
            'attr' => [
                'placeholder' => 'Lastname',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir lastname. '
                ])
            ]
                ])
        ->add('tel', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Tel',
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir num. '
                        ])
                    ]
                        ])
        ->add('address', TextType::class, [
                            'attr' => [
                                'placeholder' => 'Address',
                            ],
                            'constraints' => [
                                new NotBlank([
                                    'message' => 'Veuillez saisir address. '
                                ])
                            ]
                                ])
            ->add('password',RepeatedType::class, [
                'type'=>PasswordType::class,
                'first_options'=>['label'=>'Password'],
                'second_options'=>['label'=>'Confirm Password']
            ])
            ->add("recaptcha", ReCaptchaType::class)
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);

    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    public function onPostSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $user = $event->getData();

        if ($form->has('password') && $form->get('password')->isSubmitted()) {
            // Encode the user's password if it has been changed
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
        }
    }
}