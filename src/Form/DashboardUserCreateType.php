<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;

class DashboardUserCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label'=>"Prénom de l'utilisateur",
                'constraints'=>new Length([
                    'min'=>'2',
                    'max'=>'30',
                ]),
                'required'=>true,
            ])
            ->add('lastname',TextType::class,[
                'label'=>"Nom de l'utilisateur",
                'constraints'=> new Length([
                    'min'=>'2',
                    'max'=>'30',
                ]),
                'required'=>true,
            ])
            ->add('password', PasswordType::class,[
                'label'=>"Mot de passse de l'utilisateur",
                'constraints'=> new Length([
                    'min'=>'8',
                    'max'=>'30',
                ]),
                'required'=>true,
            ])
            ->add('roles', ChoiceType::class,[
                'required'=> true,
                'label'=>"Choisez le role de l'utilisateur",
                'multiple'=>false,
                'expanded'=>false,
                'choices'=>[
                    'User'=>'ROLE_USER',
                    'Admin'=>'ROLE_ADMIN',
                ],
            ])
            ->add('Submit', SubmitType::class,[
                'label'=>'valider'
            ])
        ;
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
