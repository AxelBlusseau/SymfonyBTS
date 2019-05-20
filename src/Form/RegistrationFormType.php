<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => false, 'attr'=>["class"=>"form-control form-register"]
            ])
            ->add('prenom', TextType::class, ['label' => false, 'attr'=>["class"=>"form-control form-register"]
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => false,
                'choices' => [ 
                    'Homme' => 'Homme', 
                    'Femme' => 'Femme', 
                ], 'attr'=>["class"=>"form-control form-register"]
            ])
            ->add('nationalite', TextType::class, ['label' => false, 'attr'=>["class"=>"form-control form-register"]
            ])
            ->add('datenaiss', DateType::class, ['label' => false, 'attr'=>["class"=>"form-control form-register"]
            ])
            ->add('email', TextType::class, ['label' => false, 'attr'=>["class"=>"form-control form-register"]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => false,
                'attr'=>["class"=>"form-control form-register"],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entrer un mot de passe",
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comprendre au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
