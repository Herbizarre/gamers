<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class,[
            'attr'=>[
                'class'=>'form-control mt-2'
            ],
            'label'=>'Nom',
            'label_attr'=>['class'=>'mt-3']
        ])
        ->add('prenom',TextType::class,[
            'attr'=>[
                'class'=>'form-control mt-2'
            ],
            'label'=>'Prénom',
            'label_attr'=>['class'=>'mt-3']
        ])
        ->add('email',TextType::class,[
            'attr'=>[
                'class'=>'form-control mt-2'
            ],
            'label'=>'Votre Email',
            'label_attr'=>['class'=>'mt-3']
        ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter nos conditions.',
                ]),
            ],
        ])
        ->add('plainPassword', RepeatedType::class, [
            'mapped'=>false,
            'type' => PasswordType::class,
            'first_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ],
            'second_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Confirmation du mot de passe',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ],
            'invalid_message' => 'Les mots de passe ne sont pas identique',

            'constraints' => [
                new NotBlank([
                    'message' => "Entrez un mot de passe s'il vous plait ",
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit contenir au moins{{ limit }} caratères',
                    'max' => 50,
                ]),
            ],
            
        ])
    ;
}
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
