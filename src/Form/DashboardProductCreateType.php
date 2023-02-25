<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
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
            ->add('illustration', FileType::class,[
                'label'=> 'Ajouter une image du produit',
                'constraints'=> new File([
                    'maxSize'=>'1024k',
                    'mimeTypes'=>[
                        'image/jpeg',
                        'image/png'
                    ],
                    'mimeTypesMessage'=>'Merci de respecter le formation jpg ou png'
                ]),
                'required'=> true,
                'mapped'=>true
            ])
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
            ->add('price', MoneyType::class,[
                'label'=>'Entrer un prix',
                'required'=>true,
                'currency'=>'EUR'

            ])

            ->add('category', EntityType::class,[
                'label'=>'Catégorie',
                'class'=>Category::class,
                'choice_label'=>'name',
                'required'=>true
            ])

            ->add('submit', SubmitType::class,[
                'label'=>"Valider"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
