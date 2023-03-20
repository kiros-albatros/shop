<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label'=>false,
                'attr'=>[
                    'class'=>'form-textarea',
                    'placeholder'=>'Ваш комментарий'
                ],
            ])
            ->add('author_name', TextType::class, [
                'label'=>false,
                'attr'=>[
                    'class'=>'form-input',
                    'placeholder'=>'Ваше Имя'
                ],
            ])
            ->add('author_email', EmailType::class, [
                'label'=>false,
                'attr'=>[
                    'class'=>'form-input',
                    'placeholder'=>'Ваш Email'
                ],
            ])
        //    ->add('product', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
