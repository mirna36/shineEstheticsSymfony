<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
        $builder
            ->add('adresses',EntityType::class,[
                'label'=>'Choisissez votre adresse de livraison.',
                'required'=>true,
                'class'=>Adresse::class,
                'choices'=> $user->getAdresses(),
                'multiple'=>false,
                'expanded'=>true
            ])
            ->add('transport',EntityType::class,[
                'label'=>'Choisissez votre mode de livraison.',
                'required'=>true,
                'class'=>Transport::class,
                'multiple'=>false,
                'expanded'=>true
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Valider ma commande',
                'attr'=>[
                    'class'=>'btn btn-success btn-block'
    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user'=>array()
        ]);
    }
}
