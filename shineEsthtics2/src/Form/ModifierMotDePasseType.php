<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifierMotDePasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('nom',TextType::class, [
                'label' => false,
                'disabled'=>true
            ])
            ->add('prenom',TextType::class, [
                'label' => false,
                'disabled'=>true
            ])
            ->add('email',EmailType::class, [
                'label' => false,
                'disabled'=>true

            ])
            ->add('old_password',PasswordType::class,[
                'mapped'=>false,
                'label' => false,
                'attr'=> [
                    'placeholder' =>'Veillez saisir votre mot de passe actuel',
                ]
            ])
            ->add('new_plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped'=>false,
                'first_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Veuillez saisir votre nouveau mot de passe'],
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => ['placeholder' => 'Veuillez confirmer votre  mot de passe'],
                ],
                'invalid_message' => 'Les champs doivent être identique!'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
