<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label'=>'Votre prénom',
                'constraints'=>new Length([
                    'min'=>'2',
                    'max'=>'30',
                ]),
                'required'=> true,
                'attr'=>[
                    'placeholder'=>'John'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label'=>'Votre nom',
                'constraints'=>new Length([
                    'min'=>'2',
                    'max'=>'30',
                ]),
                'required'=> true,
                'attr'=>[
                    'placeholder'=>'Doe'
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=>'Votre email',
                'required'=> true,
            ])
            ->add('password', PasswordType::class,[
                'label'=> 'Votre mot de passe',
                'constraints'=>new Length([
                    'min'=>'8',
                    'max'=>'30',
                ]),
                'required'=> true,
            ])

            ->add('submit', SubmitType::class,[
                'label'=>"S'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
