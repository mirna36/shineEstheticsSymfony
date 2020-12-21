<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>false,

                'attr'=>[
                    'placeholder'=>'Entrez un nom',
                ]
        ])
            ->add('prenom',TextType::class,[
                'label'=>false,

                'attr'=>[
                    'placeholder'=>'Entrez un prénom',
                ]
            ])
            ->add('entreprise',TextType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'(facultatif) Entrez une entreprise',

                ]
            ])
            ->add('adresse',TextType::class,[
                'label'=>false,

                'attr'=>[
                    'placeholder'=>'Entrez un n° et de la rue',
                ]
            ])
            ->add('Cpostal',TextType::class,[
                'label'=>false,

                'attr'=>[
                    'placeholder'=>'Entrez un code postale',
                ]
            ])
            ->add('Ville',TextType::class,[
                'label'=>false,

                'attr'=>[
                    'placeholder'=>'Entrez un nom de  ville',
                ]
            ])
            ->add('Pays',CountryType::class,[
                'label'=>false,

                'attr'=>[
                    'placeholder'=>'Le nom du pays',
                ]
            ])
            ->add('Telephone',TelType::class,[
                'label'=>false,

                'attr'=>[
                    'placeholder'=>'un numero de téléphone',
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
