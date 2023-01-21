<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('old_password',PasswordType::class,[
                'label'=>"Mot de passe actuel",
                'mapped'=>false,
                'attr'=>[
                    'placeholder'=>'Veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new_password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'mapped'=>false,
                'constraints'=>new Length([
                    'min'=>'8',
                    'max'=>'30'
                ]),
                'invalid_message'=>'Le mot de passe et la confirmation doivent être identique.',
                'label'=>'Votre mot de passe',
                'required'=>true,
                'first_options'=>[
                    'label'=>'Nouveau mot de passe'
                ],
                'second_options'=>[
                    'label'=>'confirmer votre nouveau mot de passe',
                ]
            ])

            ->add('submit', SubmitType::class,[
                'label'=>"Valider"
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
