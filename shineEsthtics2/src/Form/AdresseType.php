<?php

namespace App\Form;

use App\Entity\AdresseClient;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse',null,[
                'label'=>false,
                'attr'=>['placeholder'=>'Veuillez renseigner votre adresse'],
            ])
            ->add('ville',null,[
                'label'=>false,
                'attr'=>['placeholder'=>'Veuillez renseigner votre ville'],
            ])
            ->add('CP',NumberType::class,[
                'label'=>false,
                'attr'=>['placeholder'=>'Veuillez renseigner votre votre code postal'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdresseClient::class,
        ]);
    }
}
