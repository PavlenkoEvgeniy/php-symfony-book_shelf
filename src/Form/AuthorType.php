<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('familyName', TextType::class, [
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('firstName', TextType::class, [
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('isEnabled', ChoiceType::class, [
                'required' => true,
                'choices'  => [
                    'on'  => true,
                    'off' => false,
                ],
            ])
            ->add('books', EntityType::class, [
                'required'     => false,
                'class'        => Book::class,
                'choice_label' => 'title',
                'multiple'     => true,
                'expanded'     => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
