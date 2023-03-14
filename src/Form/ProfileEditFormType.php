<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=>'Почта',
                'label_attr' => ['class' => 'form-label'],
                'attr'=>[
                    'class'=>'form-input',
                ],
            ])
            ->add('name', TextType::class, [
                'label'=>'Имя',
                'label_attr' => ['class' => 'form-label'],
                'attr'=>[
                    'class'=>'form-input',
                ],
            ])
            ->add('avatar', FileType::class, [
                'data_class' => null,
                'label'=>'Аватар',
                'label_attr' => ['class' => 'Profile-fileLabel'],
                'attr'=>[
                    'class'=>'Profile-file form-input',
                ],
            ])
            ->add('phone', TextType::class, [
                'label'=>'Телефон',
                'label_attr' => ['class' => 'form-label'],
                'attr'=>[
                    'class'=>'form-input',
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Пароль', 'hash_property_path' => 'password', 'attr'=>[
                    'class'=>'form-input',
                ], 'label_attr' => ['class' => 'form-label']],
                'second_options' => ['label' => 'Подтверждение пароля', 'attr'=>[
                    'class'=>'form-input',
                ], 'label_attr' => ['class' => 'form-label', 'style'=>'margin-top: 25px;']],
                'mapped' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
