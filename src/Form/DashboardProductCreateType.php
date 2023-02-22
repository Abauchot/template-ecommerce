<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class DashboardProductCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label'=>'Nom du produit',
                'constraints'=> new Length([
                    'min'=>'2',
                    "max"=>'50',
                ]),
                'required'=>true
            ])
            ->add('slug', TextType::class,[
                'label'=>'Ajouter un slug',
                'constraints' => new Length([
                    'min'=>'2',
                    'max'=>'30'
                ]),
                'required'=>true
            ])
            ->add('illustration')
            ->add('subtitle', TextType::class,[
                'label'=>"Ajouter un sous-titre à l'article",
                'constraints'=> new Length([
                    'min'=>'2',
                    'max'=>'50'
                ]),
                'required'=>true
            ])
            ->add('description', TextType::class,[
                'label'=>'Ajotuer une description à produit',
                'constraints'=> new Length([
                    'min'=>'10',
                    'max'=>'50'
                ]),
                'required'=> true
            ])
            ->add('price')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
