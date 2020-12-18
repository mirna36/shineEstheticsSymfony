<?php


namespace App\Form;


use App\Entity\Shop;
use App\Utils\Recherche;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'chaine',

                null,
                [
                    'label'=>false,
                    'required'=>false,
                    'attr'=>[
                        'placeholder'=>'entrez un mot...'
                    ]

                ])
        ->add('categories',
            EntityType::class,
            //EntityFilterType::class
            [
                'label'=>false,
                'required'=>false,
                'multiple'=>true,
                'expanded'=>true,
                'class'=>Shop::class,

            ]);

    }


    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(
        [
            'data_class'=>Recherche::class,
            'method'=>'GET',
            'csrf_protection'=>false
        ]);
}
}