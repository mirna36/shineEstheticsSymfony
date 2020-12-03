<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Veuillez renseigner votre nom'],
            ])
            ->add('prenom', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Veuillez renseigner votre prenom'],
            ])
            ->add('telephone', TelType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'télèphone:0123456789'],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Veuillez renseigner votre email au format@'],
            ])
            ->add('PlainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Veuillez renseigner un mot de passe'],
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Veuillez répéter un mot de passe'],
                ],
                'invalid_message' => 'Les champs doivent être identique!'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
